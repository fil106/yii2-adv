<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Мои Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            [
                'attribute' => 'active',
                'filter' => \common\models\Project::STATUSES,
                'value' => function(\common\models\Project $model) {
                    return \common\models\Project::STATUSES[$model->active];
                }
            ],
            'createdBy.username',
            'updatedBy.username',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <?php echo \yii2mod\comments\widgets\Comment::widget([
                'model' => $model,
            ]); ?>
        </div>
    </div>

</div>
