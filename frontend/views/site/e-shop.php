<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$i = 0;
$div = false;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Beauty boxes</h1>
    </div>

    <div class="body-content">
        <?php
        // Выводим все продукты на страницу.
        /** @var \common\models\Products[] $products */
        foreach ($products as $key => $product) : ?>
            <?php if ($i == 0) {
                $div = true;
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
            <?php
            $i++;
            if (($i == 3) || (($key + 1) == count($products))) {
                $i = 0;
                if ($div) {
                    $div = false;
                    echo '</div>';
                }
            } ?>
        <?php endforeach; ?>
    </div>

</div>

