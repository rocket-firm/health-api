<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ps_products`.
 */
class m170510_010300_create_ps_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ps_products', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'domain' => $this->string()->notNull(),
            'diskusage' => $this->integer()->notNull()->defaultValue(0),
            'disklimit' => $this->integer()->notNull()->defaultValue(0),
            'description' => $this->string()->notNull(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ps_products');
    }
}
