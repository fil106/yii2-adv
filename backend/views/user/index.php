<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <?php Pjax::begin(); ?>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-bordered table-hover dataTable'
                ],
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'username',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'filter' => \common\models\User::STATUSES,
                        'value' => function(\common\models\User $model) {
                            return \common\models\User::STATUSES[$model->status];
                        }
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions'
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>