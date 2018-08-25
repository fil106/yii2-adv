<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_user`.
 */
class m180825_123826_create_project_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project_user', [
            'id' => $this->primaryKey(),
			'project_id' => $this->integer()->notNull(),
			'user_id' => $this->integer()->notNull(),
			'role' => "ENUM('manager', 'developer', 'tester')",
        ]);

		$this->addForeignKey('fk_project-user_user', 'project_user', ['user_id'], 'user', ['id']);
		$this->addForeignKey('fk_project-user_project', 'project_user', ['project_id'], 'project', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropForeignKey('fk_projectUser_user', 'project_user');
		$this->dropForeignKey('fk_projectUser_project', 'project_user');
        $this->dropTable('project_user');
    }
}
