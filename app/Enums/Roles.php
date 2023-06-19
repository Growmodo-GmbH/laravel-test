<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self ADMIN()
 * @method static self GUEST()
 */
class Roles extends Enum
{
    public static function values(): array
    {
        return [
            'ADMIN' => 'admin',
            'GUEST' => 'guest',
        ];
    }
}
