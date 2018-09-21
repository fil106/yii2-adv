<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\Project */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
    <div class="box box-success">

        <div class="box-header with-border"></div>
        <?php Pjax::begin(); ?>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-bordered table-hover dataTable'
                ],
                'columns' => [
                    [
                        'attribute' => 'title',
                        'value' => function(\common\models\Project $model) {
                            return Html::a($model->title, ['view', 'id' => $model->id]);
                        },
                        'format' => 'html'
                    ],
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

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
