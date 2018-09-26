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
                'label' => 'В проекте',
                'attribute' => 'project_id',
                'value' => function($model) {
                    return Html::a($model->project->title, ['project/view', 'id' => $model->project->id]);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Выполняет',
                'filter' => \common\models\User::find()->onlyActive(),
                'attribute' => 'executor_id',
                'value' => function ($model) {
                    return Html::a($model->executor->username, ['user/view', 'id' => $model->executor->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'created_by',
                'filter' => \common\models\User::find()->onlyActive(),
                'value' => function (\common\models\Task $model) {
                    return Html::a($model->createdBy->username, ['user/view', 'id' => $model->createdBy->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'updated_by',
                'filter' => \common\models\User::find()->onlyActive(),
                'value' => function (\common\models\Task $model) {
                    return Html::a($model->updatedBy->username, ['user/view', 'id' => $model->updatedBy->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'started_at',
                'headerOptions' => [
                    'class' => 'col-md-2'
                ],
                'format' => 'date',
                'value' => function ($model) {
                    if (extension_loaded('intl')) {
                        return $model->started_at;
                    } else {
                        return date('Y-m-d G:i:s', $model->started_at);
                    }
                },
                'filter' => \jino5577\daterangepicker\DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'started_at_range',
                    'pluginOptions' => [
                        'format' => 'd-m-Y',
                        'autoUpdateInput' => false
                    ]])
            ],
            [
                'attribute' => 'completed_at',
                'headerOptions' => [
                    'class' => 'col-md-2'
                ],
                'format' => 'date',
                'value' => function ($model) {
                    if (extension_loaded('intl')) {
                        return $model->completed_at;
                    } else {
                        return date('Y-m-d G:i:s', $model->completed_at);
                    }
                },
                'filter' => \jino5577\daterangepicker\DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'completed_at_range',
                    'pluginOptions' => [
                        'format' => 'd-m-Y',
                        'autoUpdateInput' => false
                    ]])
            ],

            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {complete} {take} {delete}',
                'buttons' => [
                    'take' => function ($url, \common\models\Task $model) {
                        $icon = \yii\bootstrap\Html::icon('hand-left');
                        return Html::a($icon, ['take', 'id' => $model->id], [
                            'data' => [
                                'confirm' => 'Вы действительно хотите принять задачу?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'complete' => function ($url, \common\models\Task $model) {
                        $icon = \yii\bootstrap\Html::icon('remove-circle');
                        return Html::a($icon, ['complete', 'id' => $model->id], [
                            'data' => [
                                'confirm' => 'Вы действительно хотите закончить задачу?',
                                'method' => 'post',
                            ]
                        ]);
                    },
                ],
                'visibleButtons' => [
                    'update' => function (\common\models\Task $model) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'complete' => function (\common\models\Task $model) {
                        return Yii::$app->taskService->canComplete($model, Yii::$app->user->identity);
                    },
                    'delete' => function (\common\models\Task $model) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    'take' => function (\common\models\Task $model) {
                        return Yii::$app->taskService->canTake($model, Yii::$app->user->identity);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
