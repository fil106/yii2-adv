<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Project;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\User';

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Project::find(),
        ]);
    }

}