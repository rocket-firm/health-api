<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m170413_162858_create_project_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'healthUrl' => $this->string(),
            'status' => $this->integer()->notNull(),
            'createdAt' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
            'updatedAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('project');
    }
}
