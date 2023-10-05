<?php

namespace Dcsb\Dcsb\Project\Service;

class ServiceDto
{
    public function __construct(
        public string $name,
        public string $imageName,
        public array $publishedPorts = [],
        public ?int $webPort = null,
    )
    {}
}