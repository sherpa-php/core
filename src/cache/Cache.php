<?php

namespace Sherpa\Core\cache;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Cache management class.
 */
class Cache
{
    private FilesystemAdapter $fileSystem;
}