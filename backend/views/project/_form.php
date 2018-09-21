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
                    'offset' => 'col-sm-offset-2',
                ],
            ],
        ]
    ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->dropDownList(\common\models\Project::STATUSES) ?>

    <?php if(!$model->isNewRecord) { ?>

        <?= $form->field($model, \common\models\Project::RELATION_PROJECT_USERS)->widget(MultipleInput::className(), [
                'id'                => 'project-users-widget',
                'max'               => 5,
                'min'               => 0,
                'addButtonPosition' => MultipleInput::POS_HEADER,
                'columns'           => [
                    [
                        'name' => 'project_id',
                        'type' => 'hiddenInput',
                        'defaultValue' => $model->id,
                    ],
                    [
                        'name' => 'user_id',
                        'type' => 'dropDownList',
                        'title' => 'User',
                        'items' => \common\models\User::find()->select('username')->indexBy('id')->column(),
                    ],
                    [
                        'name' => 'role',
                        'type' => 'dropDownList',
                        'title' => 'Role',
                        'items' => \common\models\ProjectUser::ROLES,
                    ],
                ]
            ])->label(false);
        ?>

    <?php } ?>

    <div class="form-group row">
        <div class="col-sm-2 col-sm-offset-2">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
