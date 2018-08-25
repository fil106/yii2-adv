<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m180825_123812_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
			'title' => $this->string(255)->notNull(),
			'description' => $this->text()->notNull(),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer(),
        ]);

		$this->addForeignKey('fk_project_user_1', 'project', ['created_by'], 'user', ['id']);
		$this->addForeignKey('fk_project_user_2', 'project', ['updated_by'], 'user', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropForeignKey('fk_project_user_1', 'project');
		$this->dropForeignKey('fk_project_user_2', 'project');
        $this->dropTable('project');
    }
}
