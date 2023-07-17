<?php

use app\migrations\Base\BaseMigration;
use app\models\Weather\PrecipitationType;

/**
 * Handles the creation of table `{{%precipitation_types}}`.
 */
class m230714_132303_create_precipitation_types_table extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%precipitation_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
        $this->model = new PrecipitationType();
//        $this->saveModelAndNew('clear');
//        $this->saveModelAndNew('rain');
//        $this->saveModelAndNew('snow');
//        $this->saveModelAndNew('rain with snow');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%precipitation_types}}');
    }
}
