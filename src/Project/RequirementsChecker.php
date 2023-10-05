<?php

namespace Dcsb\Dcsb\Project;

use League\Flysystem\Filesystem;
use LogicException;

class RequirementsChecker
{
    public function check(Filesystem $filesystem): void
    {
        $contents = $filesystem->listContents('');

        if (count($contents->toArray()) > 0) {
            throw new LogicException('Given dir not empty, a new project can only be created in a empty dir.');
        }
    }
}