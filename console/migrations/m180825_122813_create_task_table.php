<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m180825_122813_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
			'title' => $this->string('255')->notNull(),
			'description' => $this->text()->notNull(),
			'estimation' => $this->integer()->notNull(),
			'executor_id' => $this->integer(),
			'started_at' => $this->integer(),
			'completed_at' => $this->integer(),
			'create_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer(),
        ]);

		$this->addForeignKey('fk_user_task_1', 'task', ['executor_id'], 'user', ['id'], 'CASCADE');
		$this->addForeignKey('fk_user_task_2', 'task', ['create_by'], 'user', ['id'], 'CASCADE');
		$this->addForeignKey('fk_user_task_3', 'task', ['updated_by'], 'user', ['id'], 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropForeignKey('fk_user_task_1', 'task');
		$this->dropForeignKey('fk_user_task_2', 'task');
		$this->dropForeignKey('fk_user_task_3', 'task');
        $this->dropTable('task');
    }
}
