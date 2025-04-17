<?php

namespace Sherpa\Core\middlewares;

use Sherpa\Core\router\Request;

abstract class Middleware
{
    // TODO: implement telemetry            protected $telemetry;

    public abstract function run(Request $request): MiddlewareResponse;
}