<?php

declare(strict_types=1);

namespace App\UI\Console;

use App\Application\FlusherInterface;
use App\Domain\User\Service\UserServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends Command
{
    /** @var FlusherInterface */
    private FlusherInterface $flusher;

    private UserServiceInterface $userService;

    public function __construct(
        UserServiceInterface $userService,
        FlusherInterface $flusher
    )
    {
        parent::__construct();
        $this->flusher = $flusher;
        $this->userService = $userService;
    }

    protected function configure()
    {
        $this->setName('app:init');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->userService->generateAdmin();
        $this->userService->generateCourier();
        $this->flusher->flush();
    }

}
