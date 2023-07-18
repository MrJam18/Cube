<?php
declare(strict_types=1);

namespace app\models\Weather;


use yii\base\Model;

class WeatherForm extends Model
{
    public string $wind_speed = '';
    public string $min_air_temperature = '';
    public string $max_air_temperature = '';
    public string $rainfall = '';
    public string $date = '';
    public string $settlement = '';
    public string $wind_direction_id = '';
    public string $precipitation_type_id = '';

    public function rules(): array
    {
        return [
            [['wind_speed', 'min_air_temperature', 'max_air_temperature', 'rainfall', 'date', 'settlement', 'wind_direction_id', 'precipitation_type_id'], 'required'],
            ['wind_speed', 'integer', 'min' => 0, 'max' => 40],
            ['min_air_temperature', 'number', 'min' => -50, 'max' => 50],
            ['max_air_temperature', 'number', 'min' => -50, 'max' => 50],
            ['rainfall', 'integer', 'min' => 0, 'max' => 30],
            ['date', 'date', 'format' => ISO_DATE_FORMAT],
            [['wind_direction_id', 'precipitation_type_id'], 'integer'],
            ['settlement', 'exist', 'targetClass' => Settlement::class, 'targetAttribute' => 'name'],
            ['wind_direction_id', 'exist', 'targetClass' => WindDirection::class, 'targetAttribute' => 'id'],
            ['precipitation_type_id', 'exist', 'targetClass' => PrecipitationType::class, 'targetAttribute' => 'id']
        ];
    }

    function createWeather(): bool
    {
        if($this->validate())
        {
            $weather = new Weather();
            $this->saveWeather($weather);
            return true;
        }
        return false;
    }
    function updateWeather(string $weatherId): bool
    {
        if($this->validate())
        {
            $weather = Weather::findOne((int)$weatherId);
            $this->saveWeather($weather);
            return true;
        }
        return false;
    }

    private function saveWeather(Weather $weather): void
    {
        $weather->wind_speed = $this->wind_speed;
        $weather->min_air_temperature = $this->min_air_temperature;
        $weather->max_air_temperature = $this->max_air_temperature;
        $weather->rainfall = $this->rainfall;
        $weather->date = $this->date;
        $settlement = Settlement::find()->where(['name' => $this->settlement])->one();
        $weather->settlement_id = $settlement->id;
        $weather->wind_direction_id = $this->wind_direction_id;
        $weather->precipitation_type_id = $this->precipitation_type_id;
        $weather->author_id = \Yii::$app->user->id;
        $weather->save();
    }

}