<?php

namespace frontend\controllers;


use yii\web\Controller;

class MessageController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}