<?php

/*
 * Sherpa Framework Internal Util methods
 */

function abort(int $code): void
{
    if (ob_get_length())
    {
        ob_clean();
    }

    http_response_code($code);
    exit;
}