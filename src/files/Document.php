<?php

namespace Sherpa\Core\files;

/**
 * Class representing a document file,
 * inherited from File class.
 * <p>
 *     Used to deal with document files.
 * </p>
 */
class Document extends File
{
    /**
     * @return bool Is PDF format
     */
    public function isPdf(): bool
    {
        return $this->mime->format === "pdf";
    }

    /**
     * @return bool Is MS Word format
     */
    public function isMsWord(): bool
    {
        return $this->mime->format === "msword";
    }

    /**
     * @return bool Is MS Excel format
     */
    public function isMsExcel(): bool
    {
        return $this->mime->format === "vnd.ms-excel";
    }

    /**
     * @return bool Is MS PowerPoint format
     */
    public function isMsPowerPoint(): bool
    {
        return $this->mime->format === "vnd.ms-powerpoint";
    }

    /**
     * @return bool Is OpenDocument Text format
     */
    public function isOdt(): bool
    {
        return $this->mime->format === "vnd.oasis.opendocument.text";
    }

    /**
     * @return bool Is OpenDocument Spreadsheet format
     */
    public function isOds(): bool
    {
        return $this->mime->format === "vnd.oasis.opendocument.spreadsheet";
    }

    /**
     * @return bool Is OpenDocument Presentation format
     */
    public function isOdp(): bool
    {
        return $this->mime->format === "vnd.oasis.opendocument.presentation";
    }

    /**
     * @return bool Is RTF format
     */
    public function isRtf(): bool
    {
        return $this->mime->format === "rtf";
    }

    /**
     * @return bool Is EPUB format
     */
    public function isEpub(): bool
    {
        return $this->mime->format === "epub+zip";
    }

    /**
     * @return bool Is XHTML format
     */
    public function isXhtml(): bool
    {
        return $this->mime->format === "xhtml+xml";
    }
}