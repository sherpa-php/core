<?php

namespace Sherpa\Core\router\utils;

use Sherpa\Core\core\Sherpa;

/**
 * URI manager class
 * <p>
 *     Provides static utilities methods
 *     from current URI.
 * </p>
 */
class URI
{
    /**
     * Returns external data from current Request inputs.
     * <p>
     *     They must not contain "sherpaf__" at key beginning.
     * </p>
     *
     * @return array External data array
     */
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

    /**
     * Returns Framework's data from current Request inputs.
     * <p>
     *     They must contain "sherpaf__" at key beginning.
     * </p>
     *
     * @return array Sherpa's internal data array
     */
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

    /**
     * Returns all data from current Request inputs.
     *
     * @return array Data array
     */
    private static function getData(): array
    {
        return array_merge($_GET, $_POST, self::getPutAndDeleteData());
    }

    /**
     * Returns data if current HTTP method is PUT or DELETE.
     *
     * @return array Data array
     */
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

    /**
     * @return bool If there is the route's
     *              path in GET inputs.
     */
    public static function hasSherpaPath(): bool
    {
        return isset($_GET["sherpaf__path"]);
    }

    /**
     * @return string Current route's path
     */
    public static function getSherpaPath(): string
    {
        return self::hasSherpaPath()
            ? $_GET["sherpaf__path"]
            : "";
    }
}