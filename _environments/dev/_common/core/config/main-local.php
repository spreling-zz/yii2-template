<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/layouts/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            //todo @HJ needs to be set every template
            'siteKey' => '6LfxvgsTAAAAAJvzRn3Bh8YXiaXo2BigbO0knOMs',
            //todo @HJ needs to be set every template
            'secret' => '6LfxvgsTAAAAAMvca1YvnGvOefhQZbkXvMXADC5S',
        ],
    ],
];
