<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ApplicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заявки');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
