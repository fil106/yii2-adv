<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(!Yii::$app->user->isGuest) { ?>
            <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'title',
                'value' => function(\common\models\Task $model) {
                    return Html::a($model->title, ['view', 'id' => $model->id]);
                },
                'format' => 'html'
            ],
            'description:ntext',
            'estimation',
            [
                'label' => 'Executor',
                'attribute' => 'executor_id',
                'value' => function ($model) {
                    return Html::a($model->executor->username, ['user/view', 'id' => $model->executor->id]);
                },
                'format' => 'html',
            ],
            [
                'label' => 'Project Title',
                'attribute' => 'project_id',
                'value' => function($model) {
                    return $model->project->title;
                }
            ],
            'started_at:datetime',
            'completed_at:datetime',

            [
                'header' => 'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {take}',
                'buttons' => [
                    'take' => function ($url, \common\models\Task $model) {
                        $icon = \yii\bootstrap\Html::icon('hand-left');
                        return Html::a($icon, ['task/take', ['id' => $model->id]]);
                    },
                ],
                'visibleButtons' => [
                    'update' => function (\common\models\Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, \common\models\ProjectUser::ROLE_MANAGER);
                    },
                    'delete' => function (\common\models\Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, \common\models\ProjectUser::ROLE_MANAGER);
                    },
                    'take' => function (\common\models\Task $model, $key, $index) {
                        return Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, \common\models\ProjectUser::ROLE_DEVELOPER);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
