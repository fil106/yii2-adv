<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Пользователь: '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Аватар</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <div class="box-body box-profile">

                <?= Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_THUMB), ['class' => 'img-rounded img-responsive']) ?>

            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Данные пользователя</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'username',
                        'email:email',
                        [
                            'attribute' => 'status',
                            'value' => \common\models\User::STATUSES[$model->status],
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
                            'confirm' => 'Вы действительно хотите удалить пользователся?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
    </div>

</div>
