<?php

use yii\db\Migration;

/**
 * Handles adding project_id to table `task`.
 */
class m180902_134329_add_project_id_column_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Добавляем поле project_id с типом int после estimation
        $this->addColumn('task', 'project_id', $this->integer()->notNull()->after('estimation'));

        //Добавляем удаленный ключ в project
        $this->addForeignKey('fk_task_project','task','project_id','project','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_project','task');
        $this->dropColumn('task', 'project_id');
    }
}
