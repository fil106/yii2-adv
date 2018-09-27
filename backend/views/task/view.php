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
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>

                <div class="box-body">

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
                </div>

                <div class="box-footer">
                    <p class="pull-right">

                        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
                        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-flat',
                            'data' => [
                                'confirm' => 'Вы действительно хотите удалить задачу?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?php echo \yii2mod\comments\widgets\Comment::widget([
                        'model' => $model,
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
