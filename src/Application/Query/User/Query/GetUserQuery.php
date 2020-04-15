<?php

declare(strict_types=1);

namespace App\Application\Query\User\Query;

use App\Application\Query\QueryInterface;
use App\Domain\User\ValueObject\UserId;

class GetUserQuery implements QueryInterface
{
    private UserId $id;

    /**
     * Constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = new UserId($id);
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }
}
