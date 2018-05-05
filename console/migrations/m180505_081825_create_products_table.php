<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m180505_081825_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'cover' => $this->string(),
            'description' => $this->string(),
            'amount' => $this->float(),
            'quantity' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products');
    }
}
