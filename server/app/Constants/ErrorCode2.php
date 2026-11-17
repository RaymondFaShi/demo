<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\Annotation\Constants;
use Hyperf\Constants\Annotation\Message;
use Hyperf\Constants\EnumConstantsTrait;

#[Constants]
enum ErrorCode2: int
{
    use EnumConstantsTrait;

    #[Message("Server Error!")]
    case SERVER_ERROR = 500;
}
