<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%applications}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 */
class Applications extends \yii\db\ActiveRecord
{

    public $products;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%applications}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone', 'products'], 'required'],
            [['first_name', 'last_name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\linker\LinkerBehavior::className(),
                'relations' => [
                    'products_ids' => 'products',
                ],
            ],
        ];
    }

    public function beforeSave($insert)
    {
        $this->products_ids = explode(',', $this->products);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'phone' => Yii::t('app', 'Телефон'),
        ];
    }

    /**
     * @return Applications|\yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(
            Products::className(),
            ['id' => 'product_id']
        )->viaTable(
            '{{%applications_products}}',
            ['application_id' => 'id']
        );
    }

}
