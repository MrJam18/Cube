<?php

use app\migrations\Base\BaseMigration;
use app\models\Auth\UserRole;

/**
 * Handles the creation of table `{{%user_roles}}`.
 */
class m230714_130936_create_user_roles_table extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_roles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
//        $this->model = new UserRole();
//        $this->saveModelAndNew('admin');
//        $this->saveModelAndNew('user');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_roles}}');
    }
}
