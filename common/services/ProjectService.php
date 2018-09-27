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

    /**
     * DateRangePicker generate config for gridView filter
     * return array
     */
    public function generateDataRangeConfig($attribute, $model, $dateFormat = 'd-m-Y')
    {
        $array = array();
        $array['model'] = $model;
        $array['attribute'] = $attribute;
        $array['locale'] = 'ru-RU';
        $array['maskOptions']['mask'] = '99.99.9999 - 99.99.9999';
        $array['template'] = '
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                 </span>
                {input}
            </div>';
        $array['pluginOptions']['format'] = $dateFormat;
//        $array['pluginOptions']['timePicker'] = true;
        $array['pluginOptions']['autoUpdateInput'] = false;
        $array['pluginOptions']['locale']['cancelLabel'] = 'Закрыть';
        $array['pluginOptions']['locale']['applyLabel'] = 'Применить';

        return $array;
    }
}