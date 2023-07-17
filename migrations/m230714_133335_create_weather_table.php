<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weather}}`.
 */
class m230714_133335_create_weather_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weather}}', [
            'id' => $this->primaryKey(),
            'precipitation_type_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'settlement_id' => $this->integer()->notNull(),
            'wind_direction_id' => $this->integer()->notNull(),
            'wind_speed' => $this->integer()->notNull(),
            'min_air_temperature' => $this->float()->notNull(),
            'max_air_temperature' => $this->float()->notNull(),
            'rainfall' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'date' => $this->date()
        ]);
        $this->addForeignKey('fk-weather-precipitation_type_id', 'weather', 'precipitation_type_id', 'precipitation_types', 'id');
        $this->addForeignKey('fk-weather-author_id', 'weather', 'author_id', 'users', 'id');
        $this->addForeignKey('fk-weather-settlement_id', 'weather', 'settlement_id', 'settlements', 'id');
        $this->addForeignKey('fk-weather-wind-direction_id', 'weather', 'wind_direction_id', 'wind_directions', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weather}}');
    }
}
