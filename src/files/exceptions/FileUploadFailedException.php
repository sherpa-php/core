<?php

namespace Sherpa\Core\files\exceptions;

use Sherpa\Core\files\FileUploadError;
use Sherpa\Exceptions\exceptions\SherpaException;
use Throwable;

class FileUploadFailedException extends SherpaException
{
    public function __construct(FileUploadError $uploadError,
                                ?Throwable $previous = null)
    {
        parent::__construct($uploadError->message(), 1502, $previous);
    }
}