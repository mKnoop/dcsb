<?php

namespace Dcsb\Dcsb\Project;

use League\Flysystem\Filesystem;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class StackFileBuilder
{
    public function buildStackFile(Filesystem $filesystem, string $stackName): void
    {
        $variables = [
            'stackName' => $stackName,
            'networkName' => $stackName . '-network',
            'composeVersion' => '3.9',
        ];

        $loader = new FilesystemLoader(realpath(__DIR__ . '/../Resources/templates'));
        $twig = new Environment($loader, );

        $fileContent = $twig->render('docker-compose.yaml.twig', $variables);

        $filesystem->write('docker-compose.yml', $fileContent);
    }
}