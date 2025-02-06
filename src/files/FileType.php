<?php

namespace Sherpa\Core\files;

enum FileType
{
    case FILE;
    case IMAGE;
    case VIDEO;
    case AUDIO;
    case APPLICATION;
    case TEXT;

    /**
     * Get enum value from MIME object.
     *
     * @param MIME $mime
     * @return FileType
     */
    public static function from(MIME $mime): FileType
    {
        return match ($mime->type)
        {
            "image" => self::IMAGE,
            "audio" => self::AUDIO,
            "video" => self::VIDEO,
            "application" => self::APPLICATION,
            "text" => self::TEXT,
            default => self::FILE,
        };
    }
}
