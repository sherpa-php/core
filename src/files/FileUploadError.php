<?php

namespace Sherpa\Core\files;

use Sherpa\Core\files\exceptions\InvalidFileUploadErrorCodeException;

/**
 * This class allows to deal with
 * a request's file upload error code.
 * <p>
 *     The class permits to retrieve a code message,
 *     if the upload failed, etc.
 * </p>
 */
class FileUploadError
{
    public int $code;

    public function __construct(int|string $code)
    {
        if (!is_numeric($code))
        {
            throw new InvalidFileUploadErrorCodeException($code);
        }

        $this->code = $code;
    }

    /**
     * @return string Error's message
     */
    public function message(): string
    {
        return match($this->code) {
            UPLOAD_ERR_OK
                => 'There is no error, the file uploaded successfully.',
            UPLOAD_ERR_INI_SIZE
                => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
            UPLOAD_ERR_FORM_SIZE
                => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
            UPLOAD_ERR_PARTIAL
                => 'The uploaded file was only partially uploaded.',
            UPLOAD_ERR_NO_FILE
                => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR
                => 'Missing a temporary folder.',
            UPLOAD_ERR_CANT_WRITE
                => 'Failed to write file to disk.',
            UPLOAD_ERR_EXTENSION
                => 'A PHP extension stopped the file upload.',
        };
    }

    /**
     * @return bool If file upload has failed
     */
    public function failed(): bool
    {
        return $this->code !== UPLOAD_ERR_OK;
    }
}