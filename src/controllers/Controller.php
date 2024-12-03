<?php

namespace Sherpa\Core\controllers;

use Sherpa\Core\router\Request;

abstract class Controller
{
    abstract public function __default(Request $request);
}