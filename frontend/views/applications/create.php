<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Applications */

$this->title = Yii::t('app', 'Create Applications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row" style="background-color: #fe4c93">
        <div class="col-lg-4">
            <h2><?= $product->name ?></h2>

            <p><img width="100px" src="<?= $product->getCover() ?>" alt=""></p>
            <p><?= $product->amount ?> руб.</p>
            <p><?= $product->getQuantity() ?> шт.</p>
            <p><?= $product->description ?></p>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'product' => $product,
    ]) ?>

</div>
