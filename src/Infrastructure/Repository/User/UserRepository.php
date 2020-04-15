<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\User;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\User\AuthToken;
use App\Domain\User\ValueObject\User\Email;
use App\Domain\User\ValueObject\UserId;
use App\Infrastructure\Repository\Common\AbstractRepository;

/**
 * UserRepository.
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function existsByEmail(Email $email, ?UserId $excludeId = null): bool
    {
        $qb = $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->andWhere('u.isRemoved = false')
            ->andWhere('LOWER(u.email) = :email')->setParameter('email', mb_strtolower((string) $email));

        if ($excludeId) {
            $qb->andWhere('u.id != :id')->setParameter('id', (string) $excludeId);
        }

        return $qb->getQuery()->getSingleScalarResult() > 0;
    }

    public function fetchAll(): array
    {
        $qb = $this->createQueryBuilder('u');
        $qb->andWhere('u.isRemoved = false');
        $qb->orderBy('u.createdAt', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function get(UserId $id): User
    {
        $item = $this->findOneBy(['id' => $id, 'isRemoved' => false]);

        if ($item === null) {
            throw new UserNotFoundException();
        }

        return $item;
    }

    public function getByEmail(Email $email): User
    {
        $item = $this->findOneBy(['email' => $email, 'isRemoved' => false]);

        if ($item === null) {
            throw new UserNotFoundException();
        }

        return $item;
    }

    public function getByAuthToken(AuthToken $authToken): User
    {
        $item = $this->findOneBy(['authToken' => $authToken, 'isRemoved' => false]);

        if ($item === null) {
            throw new UserNotFoundException();
        }

        return $item;
    }

}