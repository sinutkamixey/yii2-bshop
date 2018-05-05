<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$i = 0;

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Beauty boxes</h1>
    </div>

    <div class="body-content">
        <?php /** @var \common\models\Products[] $products */
        foreach ($products as $key => $product) : ?>
            <?php if ($i > 4) {
                echo '<div class="row">';
            } ?>
            <div class="col-lg-4">
                <h2><?= $product->name ?></h2>

                <p><img width="200px" src="<?= $product->getCover() ?>" alt=""></p>
                <p><?= $product->description ?></p>
                <p><?= $product->amount ?> руб.</p>
                <p><?= $product->getQuantity() ?> шт.</p>

                <p><a class="btn btn-default" href="/applications/create?id=<?= $product->id ?>">Заказать</a>
                </p>
            </div>
            <?php if ($i > 4) {
                $i = 0;
                echo '</div>';
            } else {
                $i++;
            } ?>
        <?php endforeach; ?>
    </div>

</div>
