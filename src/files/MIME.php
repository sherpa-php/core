<?php

namespace Sherpa\Core\files;

class MIME
{
    public private(set) string $type;
    public private(set) string $format;

    public function __construct(string $type, string $format)
    {
        $this->type = strtolower($type);
        $this->format = strtolower($format);
    }

    /**
     * @param string $fileType MIME type following "type/format" format
     * @return self
     */
    public static function make(string $fileType): self
    {
        $splitType = explode('/', $fileType);

        if (!count($splitType) === 2)
        {
            // TODO: InvalidMIMEException
            echo "InvalidMIMEException";//STUB
            die;
        }

        return new MIME(...$splitType);
    }
}