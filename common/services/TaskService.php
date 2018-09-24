<?php

namespace common\services;

use common\models\Project;
use common\models\ProjectUser;
use common\models\Task;
use common\models\User;
use yii\base\Component;

class TaskService extends Component
{
    public function canManage(Project $project, User $user)
    {
        if(\Yii::$app->projectService->hasRole($project, $user, ProjectUser::ROLE_MANAGER))
            return true;
    }

    public function canTake(Task $task, User $user)
    {
        if(\Yii::$app->projectService->hasRole($task->project, $user, ProjectUser::ROLE_DEVELOPER) && is_null($task->executor_id))
            return true;
    }

    public function canComplete(Task $task, User $user)
    {
        if($task->executor_id == $user->id)
            return true;
    }

    public function takeTask(Task $task, User $user)
    {
        $task->executor_id = $user->id;
        $task->started_at = time();
        $task->save();
    }

    public function completeTask(Task $task)
    {
        $task->completed_at = time();
        $task->save();
    }
}