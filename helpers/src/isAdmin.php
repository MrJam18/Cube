<?php
declare(strict_types=1);

use app\Enums\UserRoleEnum;

function isAdmin(): bool {
    return \Yii::$app->user->getIdentity()?->role_id === UserRoleEnum::Admin->value;
}
