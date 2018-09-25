<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->projectService->hasRole($model->project, Yii::$app->user->identity, \common\models\ProjectUser::ROLE_MANAGER)) { ?>

        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

            <?php if(Yii::$app->taskService->canTake($model, Yii::$app->user->identity)) { ?>
                <?= Html::a(\yii\bootstrap\Html::icon('hand-left'), ['take', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'Вы действительно хотите принять задачу?',
                        'method' => 'post',
                    ]]) ?>
            <?php } ?>
            <?php if(Yii::$app->taskService->canComplete($model, Yii::$app->user->identity)) { ?>
                <?= Html::a(\yii\bootstrap\Html::icon('remove-circle') . ' Закончить', ['complete', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'Вы действительно хотите закончить задачу?',
                        'method' => 'post',
                    ]]) ?>
            <?php } ?>

            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            'estimation',
            [
                'label' => 'В проекте',
                'value' => function ($model) {
                    return Html::a($model->project->title, ['project/view', 'id' => $model->project->id]);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Выполняет',
                'value' => function ($model) {
                    return Html::a($model->executor->username, ['project/view', 'id' => $model->executor->id]);
                },
                'format' => 'html'
            ],
            'started_at:datetime',
            'completed_at:datetime',
            [
                'label' => 'Создал',
                'value' => function ($model) {
                    return Html::a($model->createdBy->username, ['user/view', 'id' => $model->createdBy->id]);
                },
                'format' => 'html'
            ],
            [
                'label' => 'Обновил',
                'value' => function ($model) {
                    return Html::a($model->updatedBy->username, ['user/view', 'id' => $model->updatedBy->id]);
                },
                'format' => 'html'
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <?php echo \yii2mod\comments\widgets\Comment::widget([
                'model' => $model,
            ]); ?>
        </div>
    </div>

</div>
