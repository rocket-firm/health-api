<?php

use yii\db\Migration;

/**
 * Handles adding account_id to table `ps_products`.
 */
class m170510_010611_add_account_id_column_to_ps_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('ps_products', 'account_id', $this->integer()->notNull());

        $this->addForeignKey(
            'fk_ps_products_to_ps_accounts',
            'ps_products', 'account_id', 'ps_accounts', "id",
            'CASCADE', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('ps_products', 'account_id');
    }
}
