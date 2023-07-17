<?php
declare(strict_types=1);

namespace app\models\Weather;

use app\models\Base\BaseModel;
use yii\db\ActiveQuery;

/**
 * @property int $id;
 * @property string $name;
 */
class PrecipitationType extends BaseModel
{
    function getWeather(): ActiveQuery
    {
        return $this->hasMany(Weather::class, ['precipitation_type_id' => 'id']);
    }
}