<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%deposit_types}}".
 *
 * @property int $id
 * @property string $name
 * @property int $percentage
 * @property double $min_value
 * @property int $max_duration
 * @property int $min_duration
 * @property string $description
 * @property int $currency_id
 */
class DepositTypes extends \yii\db\ActiveRecord
{
    public $fullName = '';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%deposit_types}}';
    }

    public function afterFind()
    {
        $this->fullName = $this->getFullName();
        parent::afterFind();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['percentage', 'max_duration', 'min_duration', 'currency_id'], 'integer'],
            [['min_value'], 'number'],
            [['name', 'description'], 'string', 'max' => 255],
            [['fullName'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'percentage' => Yii::t('app', 'Проценты в год'),
            'min_value' => Yii::t('app', 'Минимальная сумма'),
            'max_duration' => Yii::t('app', 'Максимальный срок (в годах)'),
            'min_duration' => Yii::t('app', 'Минимальный срок (в годах)'),
            'description' => Yii::t('app', 'Описание'),
            'currency_id' => Yii::t('app', 'Валюта'),
        ];
    }

    /**
     * @return array
     */
    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'fullName');
    }

    public function getFullName()
    {
        return "{$this->name} | Мин. сумма: {$this->min_value} | Ставка в год: {$this->percentage}%";
    }
}
