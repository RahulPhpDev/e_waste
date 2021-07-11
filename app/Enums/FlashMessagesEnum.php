<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FlashMessagesEnum extends Enum
{
     const UpdateMsg =   'Data Updated Successfully.';
     const UpdatedMsg =   'Data Updated Successfully.';
    const CreatedMsg =   'Data Created Successfully.';
    const DeletedMsg =   'Data Deleted.';
}
