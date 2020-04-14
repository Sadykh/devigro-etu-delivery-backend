<?php

declare(strict_types=1);

namespace App\Domain\User\Model;

use App\Domain\Common\Model\AggregateRoot;
use App\Domain\Common\Model\EventTrait;
use App\Domain\Common\Model\SoftRemovableTrait;
use App\Domain\Common\Model\TimestampableTrait;
use App\Domain\User\ValueObject\User\Email;
use App\Domain\User\Service\PasswordHasherInterface;
use App\Domain\User\Specification\UniqueUserEmailSpecification;
use App\Domain\User\ValueObject\User\Name;
use App\Domain\User\ValueObject\User\Password;
use App\Domain\User\ValueObject\User\Role;
use App\Domain\User\ValueObject\User\Status;
use App\Domain\User\ValueObject\UserId;

class User implements AggregateRoot
{
    use TimestampableTrait;
    use SoftRemovableTrait;
    use EventTrait;

    private UserId $id;

    private Role $role;

    private Email $email;

    private ?Password $password;

    private $name;

    private Status $status;

    /**
     * Constructor.
     * @param UserId                       $id
     * @param Role                         $role
     * @param Email                        $email
     * @param Name|null                    $name
     * @param UniqueUserEmailSpecification $uniqueUserEmailSpecification
     */
    public function __construct(
        UserId $id,
        Role $role,
        Email $email,
        ?Name $name,
        UniqueUserEmailSpecification $uniqueUserEmailSpecification
    )
    {
        $this->id = $id;
        $this->role = $role;
        $this->email = $email;
        $this->password = null;
        $this->name = $name;
        $this->status = new Status(Status::PENDING_CONFIRMATION);
        $this->triggerCreatedAt();

        if (!$uniqueUserEmailSpecification->isSatisfiedBy($this)) {
            throw new \InvalidArgumentException('Пользователь с таким e-mail уже зарегистрирован');
        }
    }

    public function login(Password $password, PasswordHasherInterface $passwordHasher): void
    {
        if (!$passwordHasher->validate((string) $this->getPassword(), (string) $password)) {
            throw new \InvalidArgumentException('Неверный пользователь или пароль');
        }

        if (!$this->status->isActive()) {
            throw new \DomainException('Пользователь не активен');
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
     * @return Password|null
     */
    public function getPassword(): ?Password
    {
        return $this->password;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

}
