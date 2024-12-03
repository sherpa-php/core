<?php

namespace Sherpa\Core\router\utils;

use Sherpa\Core\core\Sherpa;

class URI
{
    public static function getExternalData(): array
    {
        return array_filter($_REQUEST, function ($dataKey)
        {
            return !str_starts_with(
                $dataKey,
                Sherpa::SHERPA_DATA_PREFIX);
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function getSherpaData(): array
    {
        return array_filter($_REQUEST, function ($dataKey)
        {
            return str_starts_with(
                $dataKey,
                Sherpa::SHERPA_DATA_PREFIX);
        }, ARRAY_FILTER_USE_KEY);
    }
}