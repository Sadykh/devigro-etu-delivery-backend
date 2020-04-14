<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Action\Auth;

use App\Application\Command\User\Command\LoginUserCommand;
use App\UI\Http\Api\Action\AbstractAction;
use Assert\Assert;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * LoginAction.
 */
class LoginAction extends AbstractAction
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->deserialize($request);
        $result = $this->bus->handle($command);

        return $this->asJson(['token' => $result]);
    }

    private function deserialize(ServerRequestInterface $request): LoginUserCommand
    {
        $data = $request->getParsedBody();

        Assert::lazy()
            ->that($data['username'], 'username')
                ->notBlank('Заполните username')
                ->string('Неверный тип данных')
            ->that($data['password'], 'password')
                ->notBlank('Заполните пароль')
                ->string('Неверный тип данных')
            ->verifyNow();

        return new LoginUserCommand($data['username'], $data['password']);
    }
}
