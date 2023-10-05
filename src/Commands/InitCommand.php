<?php

namespace Dcsb\Dcsb\Commands;

use Dcsb\Dcsb\Project\RequirementsChecker;
use Dcsb\Dcsb\Project\StackFileBuilder;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'dcsb:init:project',
    description: 'Init a new project.',
    hidden: false
)]
class InitCommand extends Command
{
    public function __construct(private RequirementsChecker $requirementsChecker, private StackFileBuilder $stackFileBuilder)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('output-dir', InputArgument::REQUIRED, 'The dir where the project should be created');
        $this->addArgument('stackName', InputArgument::REQUIRED, 'The name of the new stack');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $outputDir = $input->getArgument('output-dir');

        $fileSystem = new Filesystem(new LocalFilesystemAdapter($outputDir));
        #$this->requirementsChecker->check($fileSystem);

        $includeTraefik = $io->confirm('Should the traefik reverse proxy be included?');

        $this->stackFileBuilder->buildStackFile($fileSystem, $includeTraefik, $stackName = $input->getArgument('stackName'));

        $io->success("Project {$stackName} successfully created");

        return self::SUCCESS;
    }
}