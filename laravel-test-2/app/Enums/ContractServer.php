<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static APP1()
 * @method static static APP2()
 */
final class ContractServer extends Enum
{
    #[Description('app1')]
    const APP1 = '0';

    #[Description('app2')]
    const APP2 = '1';
}
