<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Продукты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать продукт'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'amount',
            [
                'attribute' => 'quantity',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->getQuantity();
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} | {update} | {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('Просмотр', $url, [
                            'title' => 'Просмотр',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('Изменить', $url, [
                            'title' => 'Изменить',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Удаление', $url, [
                            'title' => 'Удаление',
                            'data-confirm' => "Вы уверены, что хотите удалить этот элемент?"
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
