<?php
declare(strict_types=1);

namespace app\models\Weather;

use app\models\Auth\User;
use app\models\Base\BaseModel;
use DateTime;
use yii\behaviors\AttributeTypecastBehavior;
use yii\db\ActiveQuery;

/**
* @property int $id;
* @property int $wind_speed;
* @property float $min_air_temperature;
* @property float $max_air_temperature;
* @property int $rainfall;
* @property string $date;
* @property DateTime $created_at;
* @property DateTime $updated_at;
* @property User $author;
* @property Settlement $settlement;
* @property WindDirection $windDirection;
* @property PrecipitationType $precipitationType;
 */
class Weather extends BaseModel
{


    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }
    public function getSettlement(): ActiveQuery
    {
        return $this->hasOne(Settlement::class, ['id' => 'settlement_id']);
    }
    public function getWindDirection(): ActiveQuery
    {
        return $this->hasOne(WindDirection::class, ['id' => 'wind_direction_id']);
    }
    public function getPrecipitationType(): ActiveQuery
    {
        return $this->hasOne(PrecipitationType::class, ['id' => 'precipitation_type_id']);
    }
    public function behaviors(): array
    {
        return [
            updateTimestampsBehavior()
        ];
    }
    static function tableName(): string
    {
        return '{{weather}}';
    }

}