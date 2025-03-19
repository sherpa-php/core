<?php

namespace Sherpa\Core\router;

/**
 * Route's parameter class.
 */
class RouteParameter
{
    public string $name;
    public bool $nullable;

    public function __construct(string $name, bool $nullable)
    {
        $this->name = $name;
        $this->nullable = $nullable;
    }
}