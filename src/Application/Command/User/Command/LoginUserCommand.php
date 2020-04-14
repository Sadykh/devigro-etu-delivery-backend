<?php

declare(strict_types=1);

namespace App\Application\Command\User\Command;

use App\Application\Command\CommandInterface;
use App\Domain\User\ValueObject\User\Email;
use App\Domain\User\ValueObject\User\Password;

class LoginUserCommand implements CommandInterface
{
    private Email $email;

    private Password $password;

    /**
     * Constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->email = new Email($username);
        $this->password = new Password($password);
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }
}
