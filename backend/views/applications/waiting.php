<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ApplicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заказы в ожидании');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(' 
$("#success").on("click", function() {
    var keys = $(\'#grid\').yiiGridView(\'getSelectedRows\');
    if (keys) {
        $.get( "/applications/change?keys=" + keys.join(",") + "&type=10", function( data ) {
            window.location="/applications/waiting";
        });
    }
});
', View::POS_READY);

?>
<div class="applications-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::button('Выполнено', [
        'class' => 'btn btn-success',
        'id' => 'success'
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'grid',
        'rowOptions' => function ($model) {
            if ($model->status == \common\models\Applications::DONE_STATUS) {
                return ['class' => 'success'];
            }
            if ($model->status == \common\models\Applications::WAIT_STATUS) {
                return ['class' => 'warning'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'yii\grid\CheckboxColumn',
                // you may configure additional properties here
            ],

            'id',
            'first_name',
            'last_name',
            'phone',
            [
                'attribute' => 'Продукт',
                'format' => 'raw',
                'value' => /**
                 * @param \common\models\Applications $data
                 * @return mixed
                 */
                    function ($data) {
                        $id = $data->getProducts()->one()->id;
                        $name = $data->getProducts()->one()->name;
                        return "<a href='/products/view?id={$id}'>$name</a>";
                    },
            ],
            'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} | {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('Просмотр', $url, [
                            'title' => 'Просмотр',
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
