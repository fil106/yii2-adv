<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['placeholder' => "Имя пользователя"])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"])->label(false) ?>

        <div class="col-xs-8">
            <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>
        </div>
        <div class="col-xs-4">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-flat', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>