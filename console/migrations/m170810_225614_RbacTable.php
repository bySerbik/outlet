<?php

use yii\db\Migration;

class m170810_225614_RbacTable extends Migration
{
    public function safeUp()
    {
        $this->execute(
            file_get_contents(
                Yii::getAlias('@yii/rbac/migrations/schema-mysql.sql')
            )
        );

    }

    public function safeDown()
    {
        $this->dropForeignKey('auth_item_child_ibfk_1', 'auth_item_child');
        $this->dropForeignKey('auth_item_child_ibfk_2', 'auth_item_child');

        $this->dropForeignKey('auth_item_ibfk_1', 'auth_item');
        $this->dropForeignKey('auth_assignment_ibfk_1', 'auth_assignment');


        $this->dropTable('auth_item_child');
        $this->dropTable('auth_item');
        $this->dropTable('auth_assignment');
        $this->dropTable('auth_rule');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170810_225614_init_rbac_table cannot be reverted.\n";

        return false;
    }
    */
}
