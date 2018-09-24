<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'title',
                'value' => function(\common\models\Project $model) {
                    return Html::a($model->title, ['view', 'id' => $model->id]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => \common\models\Project::RELATION_PROJECT_USERS.'.role',
                'value' => function(\common\models\Project $model) {
                    return join('<br>', Yii::$app->projectService->getRoles($model, Yii::$app->user->identity));
                },
                'format' => 'html'
            ],
            'description:ntext',
            [
                'attribute' => 'active',
                'filter' => \common\models\Project::STATUSES,
                'value' => function(\common\models\Project $model) {
                    return \common\models\Project::STATUSES[$model->active];
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'created_by',
                'value' => function($model) {
                    return $model->createdBy->username;
                },
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($model) {
                    return $model->updatedBy->username;
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',

            [
                'header' => 'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
