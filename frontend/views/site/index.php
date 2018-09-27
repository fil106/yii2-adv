<?php
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $user \common\models\User */
$this->title = 'Главная';
$user = Yii::$app->user->identity;
?>

<div class="container profile">
    <div class="row">
        <div class="col-md-12">
          <div class="well well-small clearfix">
            <div class="row-fluid">
              <div class="col-md-2 col-sm-3">
                 <?= Html::img($user->getThumbUploadUrl('avatar', \common\models\User::AVATAR_MIDDLE), ['class' => 'img-polaroid', 'width' => '100%']) ?>
              </div>
              <div class="col-md-4 col-sm-3">
                  <h2><?= ucfirst($user->username) ?></h2> 
                <ul class="list-unstyled">
                  <li><i class="glyphicon-envelope"></i> <?= $user->email ?></li>
                </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
</div>