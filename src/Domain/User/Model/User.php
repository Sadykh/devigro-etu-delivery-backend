<?php

declare(strict_types=1);

namespace App\Domain\User\Model;

use App\Domain\Common\Model\AggregateRoot;
use App\Domain\Common\Model\EventTrait;
use App\Domain\Common\Model\SoftRemovableTrait;
use App\Domain\Common\Model\TimestampableTrait;
use App\Domain\User\ValueObject\User\AuthToken;
use App\Domain\User\ValueObject\User\Email;
use App\Domain\User\Service\PasswordHasherInterface;
use App\Domain\User\Specification\UniqueUserEmailSpecification;
use App\Domain\User\ValueObject\User\Name;
use App\Domain\User\ValueObject\User\Password;
use App\Domain\User\ValueObject\User\Role;
use App\Domain\User\ValueObject\UserId;
use InvalidArgumentException;

class User implements AggregateRoot
{
    use TimestampableTrait;
    use SoftRemovableTrait;
    use EventTrait;

    private UserId $id;

    private Role $role;

    private Email $email;

    private Password $passwordHash;

    private Name $name;

    private AuthToken $authToken;

    /**
     * User constructor.
     * @param UserId                       $id
     * @param Role                         $role
     * @param Email                        $email
     * @param Password                     $passwordHash
     * @param Name                         $name
     * @param AuthToken                    $authToken
     * @param UniqueUserEmailSpecification $uniqueUserEmailSpecification
     */
    public function __construct(UserId $id, Role $role, Email $email, Password $passwordHash, Name $name, AuthToken $authToken, UniqueUserEmailSpecification $uniqueUserEmailSpecification)
    {
        $this->id = $id;
        $this->role = $role;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->name = $name;
        $this->authToken = $authToken;
        $this->triggerCreatedAt();

        if (!$uniqueUserEmailSpecification->isSatisfiedBy($this)) {
            throw new InvalidArgumentException('Пользователь с таким e-mail уже зарегистрирован');
        }
    }

    public function login(Password $password, PasswordHasherInterface $passwordHasher): void
    {
        if (!$passwordHasher->validate((string) $this->getPasswordHash(), (string) $password)) {
            throw new InvalidArgumentException('Неверный пользователь или пароль');
        }
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Password
     */
    public function getPasswordHash(): Password
    {
        return $this->passwordHash;
    }

    /**
     * @return AuthToken
     */
    public function getAuthToken(): AuthToken
    {
        return $this->authToken;
    }

    /**
     * @param AuthToken $authToken
     */
    public function setAuthToken(AuthToken $authToken): void
    {
        $this->authToken = $authToken;
    }
}
