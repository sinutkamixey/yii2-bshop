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
        $this->createTable('applications', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'phone' => $this->string(),
        ]);

        $this->createTable('applications_products', [
            'product_id' => $this->string(),
            'application_id' => $this->string(),
        ]);

        $this->createIndex('ix_application_id_product_id', 'applications_products', ['application_id', 'product_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('applications');
        $this->dropTable('applications_products');
    }
}
