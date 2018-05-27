<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Applications */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заявки'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Уверены, что хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
