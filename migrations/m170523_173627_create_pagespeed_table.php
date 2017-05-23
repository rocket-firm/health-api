<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pagespeed`.
 */
class m170523_173627_create_pagespeed_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pagespeed', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'desktop' => $this->integer()->notNull(),
            'mobile' => $this->integer()->notNull(),
            'usability' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pagespeed');
    }
}
