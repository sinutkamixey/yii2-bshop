<?php

use yii\db\Migration;

/**
 * Handles the creation of table `apps`.
 */
class m180505_081831_create_apps_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apps', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apps');
    }
}
