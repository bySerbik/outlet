<?php

use yii\db\Migration;

class m170831_002914_CreateRoles extends Migration
{
    public function safeUp()
    {
        $rbac = Yii::$app->authManager;

        $admin = $rbac->createRole('admin');
        $admin->description = 'Can do anything including managing users';
        $rbac->add($admin);


        $manager = $rbac->createRole('manager');
        $manager->description = 'Can do anything including managing users';
        $rbac->add($manager);

        $guest = $rbac->createRole('guest');
        $guest->description = 'Only read';
        $rbac->add($guest);

        $rbac->addChild($manager, $guest);
        $rbac->addChild($admin, $manager);

    }

    public function safeDown()
    {
        $manager = Yii::$app->authManager;
        $manager->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170831_002914_CreateRoles cannot be reverted.\n";

        return false;
    }
    */
}
