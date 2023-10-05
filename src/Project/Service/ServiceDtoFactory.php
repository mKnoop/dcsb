<?php

namespace Dcsb\Dcsb\Project\Service;

use Symfony\Component\Console\Style\SymfonyStyle;

class ServiceDtoFactory
{
    public function createFromInput(SymfonyStyle $io): ServiceDto
    {
        $serviceName = $io->ask('Service Name:');
        $image = $io->ask('Image:');

        $ports = [];
        while ($portMapping = $io->ask('Add a port mapping for the exposed ports. Empty to skip')) {
            $ports[] = $portMapping;
        }

        $webPort = $io->ask('Add the web port, Empty to skip adding the service as a web container');

        return new ServiceDto($serviceName, $image, $ports, $webPort);
    }
}