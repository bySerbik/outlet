<?php

use common\models\User;
use yii\db\Migration;

class m170822_024619_AddUser extends Migration
{

    public function safeUp()
    {
        $this->push('admin', 'admin', 'admin@gmail.com');
    }

    public function safeDown()
    {
        $this->delete('user', ['username' => 'admin']);
    }

    public function push($username, $password, $email)
    {
        $this->insert('user', ['username' => $username, 'auth_key' => Yii::$app->security->generateRandomString(32),
            'created_at' => time(), 'updated_at' => time(), 'email' => $email, 'password_hash' => Yii::$app->security->generatePasswordHash($password)]);
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170822_024619__first_user cannot be reverted.\n";

        return false;
    }
    */
}
