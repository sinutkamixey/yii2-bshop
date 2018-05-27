<?php

use yii\db\Migration;

/**
 * Class m180527_123027_alter_app_table_adding_created_at
 */
class m180527_123027_alter_app_table_adding_created_at extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{applications}}', 'created_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{applications}}', 'created_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180527_123027_alter_app_table_adding_created_at cannot be reverted.\n";

        return false;
    }
    */
}
