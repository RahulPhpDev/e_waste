<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusEnum extends Enum
{
    const PENDING =   0;
    const ACCEPT =   1;
    const DISPATCHED = 2;
    const DELIVERED = 3;
    const REJECTED = 4;
}
