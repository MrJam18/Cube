<?php
declare(strict_types=1);

namespace app\Enums;

enum UserRoleEnum: int
{
    case User = 1;
    case Admin = 2;
}