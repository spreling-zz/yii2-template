<?php
namespace commonModules\account\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;

/**
 * Login form
 */
class Login extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;

    private $_user;

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_PASS_RESET = 'passwordReset';
    const SCENARIO_PASS_RESET_REQUEST = 'passwordResetRequest';


    public function scenarios() {
        $scenarios = parent::scenarios();
        ArrayHelper::merge($scenarios, [
            self::SCENARIO_LOGIN => ['username', 'password', 'rememberMe'],
            self::SCENARIO_REGISTER => ['username', 'password', 'email'],
            self::SCENARIO_PASS_RESET => ['password'],
            self::SCENARIO_PASS_RESET_REQUEST => ['email'],
        ]);
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //required
            [['username', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            [['username', 'password', 'email'], 'required', 'on' => self::SCENARIO_REGISTER],
            ['email', 'required', 'on' => self::SCENARIO_PASS_RESET_REQUEST],
            ['password', 'required', 'on' => self::SCENARIO_PASS_RESET],

            //checks
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword', 'on' => self::SCENARIO_LOGIN],
            ['email', 'email'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on' => self::SCENARIO_REGISTER],
            ['email', 'string', 'max' => 255, 'on' => self::SCENARIO_REGISTER],
            ['password', 'string', 'min' => 6, 'on' => [self::SCENARIO_REGISTER, self::SCENARIO_PASS_RESET]],

            //filters
            ['username', 'filter', 'filter' => 'trim'],
            ['email', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => 'commonModules\account\models\Account', 'message' => 'This username has already been taken.', 'on' => self::SCENARIO_REGISTER],
            ['email', 'unique', 'targetClass' => 'commonModules\account\models\Account', 'message' => 'This email address has already been taken.', 'on' => self::SCENARIO_REGISTER],
            ['email', 'exist',
                'targetClass' => 'commonModules\account\models\Account',
                'filter' => ['status' => Account::STATUS_ACTIVE],
                'message' => 'There is no user with such email.',
                'on' => self::SCENARIO_PASS_RESET_REQUEST,
            ],

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $account = $this->getAccount();
            if (!$account || !$account->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getAccount(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return AccountLoginLogic|null
     */
    protected function getAccount()
    {
        if ($this->_user === null) {
            $this->_user = AccountLoginLogic::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * Signs user up.
     *
     * @return AccountLoginLogic|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new AccountLoginLogic();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user AccountLoginLogic */
        $user = AccountLoginLogic::findOne([
            'status' => Account::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!AccountLoginLogic::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
    public function validatedResetToken($token) {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = AccountLoginLogic::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
    }
    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        /* @var $user AccountLoginLogic */
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
