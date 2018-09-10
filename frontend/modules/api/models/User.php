<?php

namespace frontend\modules\api\models;


class User extends \common\models\User
{
    public function fields()
    {
        return [
            'id',
            'name' => 'username',
            'email',
            'status' => function($model) {
                return \common\models\User::STATUSES[$model->status];
            }
        ];
    }
}