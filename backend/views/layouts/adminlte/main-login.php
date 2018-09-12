<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">

    <div class="login-box">

        <div class="login-logo">
            <b>Admin</b>LTE</a>
        </div>

        <div class="login-box-body">

            <p class="login-box-msg">Требуется авторизация</p>

            <?php $this->beginBody() ?>

            <?= $content ?>

            <?php $this->endBody() ?>

            <div class="row">
                <div class="col-xs-12">
                    <a href="#">Напомнить пароль</a><br>
                    <a href="register.html" class="text-center">Зарегистрироваться</a>
                </div>
            </div>

        </div>

    </div>
</body>
</html>
<?php $this->endPage() ?>