<?php

use yii\db\Migration;

/**
 * Class m190913_165347__createTrigger
 */
class m190913_165347__createTrigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $query = <<< SQL
        CREATE TRIGGER updateOfUser
          BEFORE UPDATE
          ON user
          FOR EACH ROW
        BEGIN

          DELETE
          FROM auth_assignment
          WHERE user_id = NEW.id;

END;
SQL;

        $command = Yii::$app->db->createCommand("$query");
        $command->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $query = <<< SQL
        DROP TRIGGER IF EXISTS updateOfUser;
SQL;

        $command = Yii::$app->db->createCommand("$query");
        $command->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_165347__createTrigger cannot be reverted.\n";

        return false;
    }
    */
}
