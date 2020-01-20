<?php

use yii\db\Migration;

/**
 * Class m200120_165840_alter_table_history_add_index_ins_ts_idx
 */
class m200120_165840_alter_table_history_add_index_ins_ts_idx extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('ins_ts_idx', 'history', 'ins_ts');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ins_ts_idx', 'history');
    }
}
