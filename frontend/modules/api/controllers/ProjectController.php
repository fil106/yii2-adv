<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\Project;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class ProjectController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\models\Project';

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Project::find(),
        ]);
    }

}