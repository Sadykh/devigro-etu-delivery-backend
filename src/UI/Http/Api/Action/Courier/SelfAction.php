<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Action\Courier;

use App\Application\Query\User\Query\GetUserQuery;
use App\Domain\User\Model\User;
use App\UI\Http\Api\Action\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SelfAction extends AbstractAction
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->auth($request);
        $command = new GetUserQuery((string) $this->user->getId());
        /** @var User $result */
        $result = $this->bus->handle($command);

        return $this->asJson([
            'id' => (string) $result->getId(),
            'username' => (string) $result->getEmail(),
            'phone' => (string) $result->getEmail(),
            'name' => (string) $result->getName(),
            'fullName' => (string) $result->getName(),
        ]);
    }

}
