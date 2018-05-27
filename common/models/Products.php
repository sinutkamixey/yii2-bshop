<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $name
 * @property string $cover
 * @property string $description
 * @property double $amount
 * @property int $quantity
 */
class Products extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
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
                    'application_ids' => 'applications',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'quantity'], 'required'],
            [['amount'], 'number'],
            [['quantity'], 'integer'],
            [['name', 'cover', 'description'], 'string', 'max' => 255],
//            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
            [['imageFile'], 'safe']
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
            'cover' => Yii::t('app', 'Обложка'),
            'description' => Yii::t('app', 'Описание'),
            'imageFile' => Yii::t('app', 'Обложка'),
            'amount' => Yii::t('app', 'Сумма'),
            'quantity' => Yii::t('app', 'Количество'),
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $name = $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs(
                Yii::getAlias('@frontend/web/') . 'uploads/' . $name
            );
            $this->cover = $name;
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return Applications|\yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(
            Applications::className(),
            ['id' => 'application_id']
        )->viaTable(
            '{{%applications_products}}',
            ['product_id' => 'id']
        );
    }

    public function getCover()
    {
        if (file_exists(Yii::getAlias('@frontend/web/uploads/' . $this->cover))) {
            return '/uploads/' . $this->cover;
        }
        return '';
    }

    public function getQuantity()
    {
        $count = count($this->application_ids) ?? 0;
        return $this->quantity - $count;
    }

}
