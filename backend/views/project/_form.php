<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-4',
                ],
            ],
        ]
    ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->dropDownList(\common\models\Project::STATUSES) ?>

    <?php
        echo $form->field($model, 'emails')->widget(MultipleInput::className(), [
            'max'               => 6,
            'min'               => 2, // should be at least 2 rows
            'allowEmptyList'    => false,
            'enableGuessTitle'  => true,
            'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        ])->label(false);
    ?>

    <div class="form-group row">
        <div class="col-sm-2 col-sm-offset-2">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
