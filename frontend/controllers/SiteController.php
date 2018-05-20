<?php

namespace frontend\controllers;

use common\models\Products;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     * Метод, который отображает главную страницу.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays e-shop.
     * Метод, который получает список всех продуктов
     * и отображает на странице интернет-магазина
     *
     * @return mixed
     */
    public function actionShop()
    {
        return $this->render('e-shop', [
            'products' => Products::find()->all() // Получение всех продуктов
        ]);
    }


}
