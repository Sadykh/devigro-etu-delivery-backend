<?php

declare(strict_types=1);

namespace App\UI\Console;

use App\Application\FlusherInterface;
use App\Domain\Tariff\Model\Tariff;
use App\Domain\Tariff\Repository\TariffRepositoryInterface;
use App\Domain\Tariff\ValueObject\Name;
use App\Domain\Tariff\ValueObject\Note;
use App\Domain\Tariff\ValueObject\Price;
use App\Domain\Tariff\ValueObject\TariffId;
use App\Domain\User\Model\Country;
use App\Domain\User\Repository\CountryRepositoryInterface;
use App\Domain\User\ValueObject\CountryId;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends Command
{
    /** @var FlusherInterface */
    private FlusherInterface $flusher;

    public function __construct(
        FlusherInterface $flusher
    )
    {
        parent::__construct();
        $this->flusher = $flusher;
    }

    protected function configure()
    {
        $this->setName('app:init');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}
