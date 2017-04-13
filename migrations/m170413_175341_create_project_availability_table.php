<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_availability`.
 */
class m170413_175341_create_project_availability_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('project_availability', [
            'id' => $this->primaryKey(),
            'responseCode' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'createdAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'projectId' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk_project_availability', 'project_availability', 'projectId',
            'project', 'id', 'CASCADE', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('project_availability');
    }
}
