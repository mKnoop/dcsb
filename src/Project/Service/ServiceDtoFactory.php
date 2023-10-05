<?php

namespace Dcsb\Dcsb\Project\Service;

use Symfony\Component\Console\Style\SymfonyStyle;

class ServiceDtoFactory
{
    public function createFromInput(SymfonyStyle $io): ServiceDto
    {
        $serviceName = $io->ask('Service Name:');
        $image = $io->ask('Image:');

        return new ServiceDto($serviceName, $image);
    }
}