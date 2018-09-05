<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <div class="row">

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
        <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*']) ?>

    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">

            <strong>Current avatar</strong>

            <?= Html::img($model->getThumbUploadUrl('avatar', \common\models\User::AVATAR_THUMB), ['class' => 'img-rounded img-responsive']) ?>

        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2 col-sm-offset-2">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
