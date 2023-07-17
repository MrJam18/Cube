<?php
declare(strict_types=1);

use yii\behaviors\TimestampBehavior;

function updateTimestampsBehavior(): array {
    return [
        'class' => TimestampBehavior::class,
        'createdAtAttribute' => 'created_at',
        'updatedAtAttribute' => 'updated_at',
        'value' => function(){ return date(ISO_DATE_TIME_FORMAT);},
    ];
}
