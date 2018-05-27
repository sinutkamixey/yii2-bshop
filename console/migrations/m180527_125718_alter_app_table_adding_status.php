<?php

use yii\db\Migration;

/**
 * Class m180527_125718_alter_app_table_adding_status
 */
class m180527_125718_alter_app_table_adding_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{applications}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{applications}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180527_125718_alter_app_table_adding_status cannot be reverted.\n";

        return false;
    }
    */
}
