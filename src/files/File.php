<?php

namespace Sherpa\Core\files;

class File
{
    public protected(set) string $name;
    public protected(set) string $fullPath;
    public protected(set) MIME $mime;
    public protected(set) string $tempName;
    public protected(set) string $error;
    public protected(set) int $size;

    public static function make(array $file): static
    {
        if (!self::validate($file))
        {
            // TODO: InvalidFileException
            echo "InvalidFileException";//STUB
            die;
        }

        $name = $file["name"];
        $fullPath = $file["full_path"];
        $type = $file["type"];
        $tempName = $file["tmp_name"];
        $error = $file["error"];
        $size = $file["size"];

        $mime = MIME::make($type);

        return match (FileType::from($mime))        // TODO: add data to constructors
        {
            FileType::AUDIO => new Audio(),
            FileType::IMAGE => new Image(),
            FileType::VIDEO => new Video(),
            FileType::APPLICATION => new Application(),
            FileType::TEXT => new Text(),
            default => new File(),
        };

        // TODO ...
    }

    /**
     * Validates provided file array's format.
     * <ul>
     *     <li>It verifies if all required keys are provided.</li>
     * </ul>
     *
     * @param array $file File array
     * @return bool If provided file array is valid
     */
    public static function validate(array $file): bool
    {
        $requiredKeys = [
            "name",
            "full_path",
            "type",
            "tmp_name",
            "error",
            "size",
        ];

        $hasKeys = array_walk(
            $requiredKeys,
            function ($key) use ($file)
            {
                return in_array($key, array_keys($file));
            });

        return $hasKeys;
    }
}