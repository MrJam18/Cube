<?php
declare(strict_types=1);

namespace app\models\Weather;

use app\models\Auth\User;
use app\models\Base\BaseModel;
use yii\db\ActiveQuery;

/**
 * @property int $id;
 * @property string $name;
 * @property User $author;
 */
class Settlement extends BaseModel
{
    public function getWeather(): ActiveQuery
    {
        return $this->hasMany(Weather::class, ['settlement_id' => 'id']);
    }
    function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }
    public function behaviors(): array
    {
        return [
            updateTimestampsBehavior()
        ];
    }
}