<?php

use yii\db\Migration;

class m170523_175847_add_foreign_key_to_pagespeed_table extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('fk_pagespeed_project', 'pagespeed', 'project_id', 'project', 'id',
            'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_pagespeed_project', 'pagespeed');
    }
}
