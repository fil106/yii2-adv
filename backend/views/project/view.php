<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">
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
                        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Вы действительно хотите удалить проект?',
                                'method' => 'post',
                            ],
                        ]) ?>
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
