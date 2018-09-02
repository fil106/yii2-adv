<?php

use yii\db\Migration;

/**
 * Handles adding active to table `project`.
 */
class m180902_133208_add_active_column_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Добавляем поле active с типом bit после description
        $this->addColumn('project', 'active', $this->boolean()->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('project', 'active');
    }
}
