<?php
declare(strict_types=1);

namespace app\migrations\Base;

use app\models\Base\BaseModel;
use yii\db\Migration;

class BaseMigration extends Migration
{
    protected BaseModel $model;

    protected function saveModelAndNew(string $columnData, string $column = 'name')
    {
        $this->model->$column = $columnData;
        $this->model->save();
        $this->model = new (get_class($this->model));
    }
}