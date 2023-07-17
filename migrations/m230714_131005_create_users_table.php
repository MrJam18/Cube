<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m230714_131005_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'role_id' => $this->integer()->notNull()->defaultValue(1),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'access_token' => $this->string()->null(),
            'email' => $this->string()->notNull()->unique()
        ]);
        $this->addForeignKey('fk-users-role_id', 'users', 'role_id', 'user_roles', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
