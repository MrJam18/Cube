<?php

use app\migrations\Base\BaseMigration;
use app\models\Weather\WindDirection;

/**
 * Handles the creation of table `{{%wind_directions}}`.
 */
class m230714_132002_create_wind_directions_table extends BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wind_directions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
        $this->model = new WindDirection();
//        $this->saveModelAndNew('south');
//        $this->saveModelAndNew('north');
//        $this->saveModelAndNew('west');
//        $this->saveModelAndNew('east');
//        $this->saveModelAndNew('southwest');
//        $this->saveModelAndNew('southeast');
//        $this->saveModelAndNew('northeast');
//        $this->saveModelAndNew('northwest');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wind_directions}}');
    }
}
