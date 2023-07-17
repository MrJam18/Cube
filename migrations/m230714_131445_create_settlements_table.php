<?php

use app\migrations\Base\BaseMigration;
use app\models\Weather\Settlement;

/**
 * Handles the creation of table `{{%settlements}}`.
 */
class m230714_131445_create_settlements_table extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settlements}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'author_id' => $this->integer()->notNull()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settlements}}');
    }
}
