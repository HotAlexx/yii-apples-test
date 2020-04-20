<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200420_121011_apples_table
 */
class m200420_121011_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apples', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->notNull(),
            'date_of_birth' => $this->timestamp()->defaultValue(null),
            'date_of_fall' => $this->timestamp()->defaultValue(null),
            'status' => $this->integer()->notNull(),
            'percent' => $this->float()->notNull(),
            'is_fell' => $this->boolean()->notNull(),
            'is_rotten' => $this->boolean()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apples');
    }

}
