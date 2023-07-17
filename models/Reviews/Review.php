<?php
declare(strict_types=1);

namespace app\models\Reviews;

use app\models\Auth\User;
use app\models\Base\BaseModel;
use app\models\Traits\USTimestampsTrait;
use yii\db\ActiveQuery;

/**
 * @property int $id;
 * @property string $title;
 * @property string $text;
 * @property string $created_at;
 * @property string $updated_at;
 * @property User $author;
 */
class Review extends BaseModel
{
    use USTimestampsTrait;
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