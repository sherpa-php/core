<?php

namespace Sherpa\Core\validation;

use Sherpa\Core\validation\enums\Response;

interface Rule
{
    public function handle(): bool|Response;
}