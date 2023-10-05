<?php

namespace Dcsb\Dcsb\Project;

use League\Flysystem\Filesystem;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StackFileBuilder
{
    public function buildStackFile(Filesystem $filesystem, bool $includeTraefik, string $stackName, array $services): void
    {
        $variables = [
            'stackName' => $stackName,
            'networkName' => $stackName . '-network',
            'includeTraefik' => $includeTraefik,
            'composeVersion' => '3.9',
            'services' => $services
        ];

        $loader = new FilesystemLoader(realpath(__DIR__ . '/../Resources/templates'));
        $twig = new Environment($loader, );

        $fileContent = $twig->render('docker-compose.yaml.twig', $variables);

        $filesystem->write('docker-compose.yml', $fileContent);
    }
}