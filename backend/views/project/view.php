<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \common\models\TaskSearch */

$this->title = 'Страница проекта: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Детали проекта</h3>
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
                            [
                                'attribute' => 'Tasks',
                                'value' => function (\common\models\Project $project) {
                                    return $project->getTasks()->count();
                                },
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'active',
                                'filter' => \common\models\Project::STATUSES,
                                'value' => function(\common\models\Project $model) {
                                    return \common\models\Project::STATUSES[$model->active];
                                }
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
                        ],
                    ]) ?>
                </div>

                <div class="box-footer">
                    <p class="pull-right">
                        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
                        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-flat',
                            'data' => [
                                'confirm' => 'Вы действительно хотите удалить проект?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Задачи проекта</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'attribute' => 'title',
                                'value' => function(\common\models\Task $model) {
                                    return Html::a($model->title, ['task/view', 'id' => $model->id]);
                                },
                                'format' => 'html'
                            ],
                            'description:ntext',
                            'estimation',
                            [
                                'attribute' => 'executor',
                                'value' => function (\common\models\Task $model) {
                                    return Html::a($model->executor->username, ['user/view', 'id' => $model->executor->id]);
                                },
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'created_by',
                                'value' => function($model) {
                                    return Html::a($model->createdBy->username, ['user/view', 'id' => $model->createdBy->id]);
                                },
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'updated_by',
                                'value' => function($model) {
                                    return Html::a($model->updatedBy->username, ['user/view', 'id' => $model->updatedBy->id]);
                                },
                                'format' => 'html',
                            ],
                            'started_at:datetime',
                            'completed_at:datetime',
                        ],
                    ]); ?>
                </div>

                <div class="box-footer">
                    <p class="pull-right">
                        <?= Html::a('Создать задачу', ['task/create'], ['class' => 'btn btn-success btn-flat']) ?>
                    </p>
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
