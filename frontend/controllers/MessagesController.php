<?php

namespace frontend\controllers;


use yii\web\Controller;

class MessagesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}