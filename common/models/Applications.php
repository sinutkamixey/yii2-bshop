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
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 * @property int $status [int(11)]
 */
class Applications extends \yii\db\ActiveRecord
{

    const DONE_STATUS = 10;
    const WAIT_STATUS = 20;
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
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer']
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
        $this->created_at = (new \DateTime('now'))->format('Y-m-d H:i');
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
            'created_at' => Yii::t('app', 'Дата создания'),
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
