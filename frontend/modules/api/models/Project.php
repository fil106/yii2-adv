<?php

namespace frontend\modules\api\models;


class Project extends \common\models\Project
{
    public function fields()
    {
        return [
            'id',
            'title',
            'created_by',
        ];
    }

    public function extraFields()
    {
        return ['tasks'];
    }
}