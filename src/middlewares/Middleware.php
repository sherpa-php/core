<?php

use Sherpa\Core\router\Request;

interface Middleware
{
    public function run(Request $request);
}