<?php

namespace Sherpa\Core\controllers;

use Sherpa\Core\router\Request;

abstract class Controller
{
    public function __default(Request $request)
    { }
}