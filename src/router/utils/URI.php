<?php

namespace Sherpa\Core\router\utils;

use Sherpa\Core\core\Sherpa;

class URI
{
    public static function getExternalData(): array
    {
        return array_filter(self::getData(),
            function ($dataKey)
            {
                return !str_starts_with(
                    $dataKey,
                    Sherpa::SHERPA_DATA_PREFIX);
            }, ARRAY_FILTER_USE_KEY);
    }

    public static function getSherpaData(): array
    {
        return array_filter(self::getData(),
            function ($dataKey)
            {
                return str_starts_with(
                    $dataKey,
                    Sherpa::SHERPA_DATA_PREFIX);
            }, ARRAY_FILTER_USE_KEY);
    }

    private static function getData(): array
    {
        return array_merge($_GET, $_POST, self::getPutAndDeleteData());
    }

    private static function getPutAndDeleteData(): array
    {
        if ($_SERVER["REQUEST_METHOD"] === "PUT"
            || $_SERVER["REQUEST_METHOD"] === "DELETE")
        {
            parse_str(file_get_contents("php://input"), $data);
            return $data;
        }

        return [];
    }

    public static function hasSherpaPath(): bool
    {
        return isset($_GET["sherpaf__path"]);
    }

    public static function getSherpaPath(): string
    {
        return self::hasSherpaPath()
            ? $_GET["sherpaf__path"]
            : "";
    }
}