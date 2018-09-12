<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\Task */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="box-body">
            <p>
                <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'title',
                    'description:ntext',
                    'estimation',
                    [
                        'attribute' => 'project_id',
                        'value' => function($model) {
                            return $model->project->title;
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
</div>
