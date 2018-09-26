<?php

namespace common\services;

use common\models\Project;
use common\models\ProjectUser;
use common\models\User;
use yii\base\Component;
use yii\base\Event;

class AssignRoleEvent extends Event
{
    public $project;
    public $user;
    public $role;

    public function dump()
    {
        return [
            'project' => $this->project->id,
            'user' => $this->user->id,
            'role' => $this->role,
        ];
    }
}

class ProjectService extends Component
{
    const EVENT_ASSIGN_ROLE = 'event_assign_role';

    public function getRoles(Project $project, User $user)
    {
        return $project->getProjectUsers()->byUser($user->id)->select('role')->column();
    }

    public function hasRole(Project $project, User $user, $role)
    {
        return in_array($role, $this->getRoles($project, $user));
    }

    public function canUpdate(Project $project, User $user)
    {
        if($this->hasRole($project, $user, ProjectUser::ROLE_MANAGER) || $this->hasRole($project, $user, ProjectUser::ROLE_DEVELOPER))
            return true;
    }

    public function canDelete(Project $project, User $user)
    {
        if($this->hasRole($project, $user, ProjectUser::ROLE_DEVELOPER))
            return true;
    }

    /**
     * @param Project $project
     * @param User $user
     * @param $role
     */
    public function assignRole(Project $project, User $user, $role)
    {
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;

        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }
}