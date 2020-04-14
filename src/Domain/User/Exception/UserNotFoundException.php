<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

use App\Domain\Common\Exception\NotFoundException;

/**
 * UserNotFoundException.
 */
class UserNotFoundException extends NotFoundException
{

    protected $message = 'UserNotFoundException';
}
