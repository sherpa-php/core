<?php

namespace Sherpa\Core\controllers;

use Sherpa\Core\router\Request;

/**
 * Sherpa controller main class.
 */
abstract class Controller
{
    /**
     * Default controller method
     *
     * @param Request $request
     */
    public function __default(Request $request)
    { }
}