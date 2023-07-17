<?php
declare(strict_types=1);

namespace app\models\Base;

use yii\db\ActiveRecord;

abstract class BaseModel extends ActiveRecord
{
    public static function tableName(): string
    {
        $tableName = rtrim(parent::tableName(), '}');
        return $tableName . 's}}';
    }

}