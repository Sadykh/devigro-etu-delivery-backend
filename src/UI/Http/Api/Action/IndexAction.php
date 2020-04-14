<?php

declare(strict_types=1);

namespace App\UI\Http\Api\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * IndexAction.
 */
class IndexAction extends AbstractAction
{
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return $this->asJson(['status' => 'ok']);
    }
}
