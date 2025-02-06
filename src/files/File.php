<?php

namespace Sherpa\Core\files;

use Sherpa\Core\files\exceptions\FileUploadFailedException;
use Sherpa\Core\files\exceptions\InvalidFileException;

class File
{
    public protected(set) string $name;
    public protected(set) string $fullPath;
    public protected(set) MIME $mime;
    public protected(set) string $tempName;
    public protected(set) string $error;
    public protected(set) int $size;

    public function __construct(
        string $name,
        string $fullPath,
        MIME $mime,
        string $tempName,
        string $error,
        int $size)
    {
        $this->name = $name;
        $this->fullPath = $fullPath;
        $this->mime = $mime;
        $this->tempName = $tempName;
        $this->error = $error;
        $this->size = $size;
    }


    public static function make(array $file): static
    {
        if (!self::validate($file))
        {
            throw new InvalidFileException();
        }

        $error = $file["error"];
        $uploadError = new FileUploadError($error);

        if ($uploadError->failed())
        {
            throw new FileUploadFailedException($uploadError);
        }

        $name = $file["name"];
        $fullPath = $file["full_path"];
        $type = $file["type"];
        $tempName = $file["tmp_name"];
        $size = $file["size"];

        $mime = MIME::make($type);

        return match (FileType::from($mime))
        {
            FileType::AUDIO => new Audio(
                $name,
                $fullPath,
                $mime,
                $tempName,
                $error,
                $size),
            FileType::IMAGE => new Image(
                $name,
                $fullPath,
                $mime,
                $tempName,
                $error,
                $size),
            FileType::VIDEO => new Video(
                $name,
                $fullPath,
                $mime,
                $tempName,
                $error,
                $size),
            FileType::APPLICATION => new Application(
                $name,
                $fullPath,
                $mime,
                $tempName,
                $error,
                $size),
            FileType::TEXT => new Text(
                $name,
                $fullPath,
                $mime,
                $tempName,
                $error,
                $size),
            default => new File(
                $name,
                $fullPath,
                $mime,
                $tempName,
                $error,
                $size),
        };
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