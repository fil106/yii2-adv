<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="col-md-3">

        <div class="box box-info">
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

    <div class="col-md-5">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Данные пользователя</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <div class="box-body">

                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-2',
                            'offset' => 'col-sm-offset-4',
                        ],
                    ],
                    'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'email')->textInput() ?>
                <?= $form->field($model, 'status')->dropDownList(\common\models\User::STATUSES) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*'])->label('Аватар') ?>

            </div>
            <div class="box-footer">
                <p class="pull-right">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
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

    <?php ActiveForm::end(); ?>

</div>
