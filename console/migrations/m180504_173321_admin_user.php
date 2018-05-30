<?php

use yii\db\Migration;

/**
 * Class m180504_173321_admin_user
 */
class m180504_173321_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'sinutkamixey',
            'email' => 'sinutkamixey@admin.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('qwerty'),
            'auth_key' => '',
            'status' => '20',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
