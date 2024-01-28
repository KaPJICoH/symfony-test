<?php

namespace App\Application\UI\User\Command;

use App\Application\Operation\User\Handler\CreateUserHandler;
use App\Application\Operation\User\Request\CreateUserRequest;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'client:create',
    description: 'Command to create a client',
)]
class CreateClientCommand extends Command
{
    public function __construct(private readonly CreateUserHandler $createUserHandler)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'Username for client')
            ->addArgument('password', InputArgument::REQUIRED, 'password for client');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $io->note(sprintf('You passed an argument: %s, %s', $username, $password));
        $this->createUserHandler->handle(new CreateUserRequest($username, $password));

        $io->success('Client Successfully created');

        return Command::SUCCESS;
    }
}
