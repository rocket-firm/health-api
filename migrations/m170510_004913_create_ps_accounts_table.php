<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ps_accounts`.
 */
class m170510_004913_create_ps_accounts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ps_accounts', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ps_accounts');
    }
}
