<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static AWS()
 * @method static static K5()
 * @method static static T2()
 */
final class AppEnv extends Enum
{
    #[Description('AWS')]
    const AWS = '0';

    #[Description('K5')]
    const K5 = '1';

    #[Description('T2')]
    const T2 = '2';
}
