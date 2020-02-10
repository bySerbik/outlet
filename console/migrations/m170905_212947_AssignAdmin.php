<?php

use common\models\User;
use yii\db\Migration;

class m170905_212947_AssignAdmin extends Migration
{
    public function safeUp()
    {
        $rbac = Yii::$app->authManager;
        $admin = $rbac->getRole('admin');
        if ($id = User::findByUsername('admin')->id)
            $rbac->assign($admin, $id);

    }

    public function safeDown()
    {
        $rbac = Yii::$app->authManager;
        $rbac->removeAllAssignments();
        $rbac->removeAllPermissions();

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170905_212947_AssignAdmin cannot be reverted.\n";

        return false;
    }
    */
}
