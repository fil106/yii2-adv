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
                'filter' => \common\models\User::find()->onlyActive(),
                'value' => function (\common\models\Project $model) {
                    return Html::a($model->createdBy->username, ['user/view', 'id' => $model->createdBy->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'updated_by',
                'filter' => \common\models\User::find()->onlyActive(),
                'value' => function (\common\models\Project $model) {
                    return Html::a($model->updatedBy->username, ['user/view', 'id' => $model->updatedBy->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'created_at',
                'headerOptions' => [
                    'class' => 'col-md-3'
                ],
                'format' => 'datetime',
                'value' => 'created_at',
                'filter' => \jino5577\daterangepicker\DateRangePicker::widget(
                    Yii::$app->projectService->generateDataRangeConfig('created_at_range', $searchModel)
                )
            ],
            [
                'attribute' => 'updated_at',
                'headerOptions' => [
                    'class' => 'col-md-3'
                ],
                'format' => 'datetime',
                'value' => 'updated_at',
                'filter' => \jino5577\daterangepicker\DateRangePicker::widget(
                    Yii::$app->projectService->generateDataRangeConfig('updated_at_range', $searchModel)
                )
            ],
            [
                'header' => 'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
