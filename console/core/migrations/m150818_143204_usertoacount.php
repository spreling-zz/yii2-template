<?php

use yii\db\Schema;
use yii\db\Migration;

class m150818_143204_usertoacount extends Migration
{
    public function up()
    {
        $this->renameTable('{{%user}}', '{{%account}}');
    }

    public function down()
    {
        $this->renameTable('{{%account}}', '{{%user}}');
    }
}
