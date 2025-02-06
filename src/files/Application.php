<?php

namespace Sherpa\Core\files;

/**
 * Class representing an application file,
 * inherited from File class.
 * <p>
 *     Used to deal with application files.
 * </p>
 */
class Application extends File
{
    /**
     * @return bool Is JavaScript format
     */
    public function isJavascript(): bool
    {
        return $this->mime->format === "javascript";
    }

    /**
     * @return bool Is TypeScript format
     */
    public function isTypescript(): bool
    {
        return $this->mime->format === "typescript";
    }

    /**
     * @return bool Is SQL format
     */
    public function isSql(): bool
    {
        return $this->mime->format === "sql";
    }

    /**
     * @return bool Is YAML format
     */
    public function isYaml(): bool
    {
        return $this->mime->format === "x-yaml";
    }

    /**
     * @return bool Is CSV format
     */
    public function isCsv(): bool
    {
        return $this->mime->format === "csv";
    }

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
     * @return bool Is ZIP format
     */
    public function isZip(): bool
    {
        return $this->mime->format === "zip";
    }

    /**
     * @return bool Is GZIP format
     */
    public function isGzip(): bool
    {
        return $this->mime->format === "x-gzip";
    }

    /**
     * @return bool Is RAR format
     */
    public function isRar(): bool
    {
        return $this->mime->format === "x-rar-compressed";
    }

    /**
     * @return bool Is 7-Zip format
     */
    public function is7z(): bool
    {
        return $this->mime->format === "x-7z-compressed";
    }

    /**
     * @return bool Is JSON format
     */
    public function isJson(): bool
    {
        return $this->mime->format === "json";
    }

    /**
     * @return bool Is XML format
     */
    public function isXml(): bool
    {
        return $this->mime->format === "xml";
    }

    /**
     * @return bool Is Java Archive format
     */
    public function isJar(): bool
    {
        return $this->mime->format === "java-archive";
    }

    /**
     * @return bool Is Shockwave Flash format
     */
    public function isSwf(): bool
    {
        return $this->mime->format === "x-shockwave-flash";
    }

    /**
     * @return bool Is PostScript format
     */
    public function isPostScript(): bool
    {
        return $this->mime->format === "postscript";
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

    /**
     * @return bool Is RTF format
     */
    public function isRtf(): bool
    {
        return $this->mime->format === "rtf";
    }

    /**
     * @return bool Is Font WOFF format
     */
    public function isFontWoff(): bool
    {
        return $this->mime->format === "font-woff";
    }

    /**
     * @return bool Is Font WOFF2 format
     */
    public function isFontWoff2(): bool
    {
        return $this->mime->format === "font-woff2";
    }

    /**
     * @return bool Is Font TTF format
     */
    public function isFontTtf(): bool
    {
        return $this->mime->format === "font-ttf";
    }

    /**
     * @return bool Is Font OTF format
     */
    public function isFontOtf(): bool
    {
        return $this->mime->format === "font-otf";
    }

    /**
     * @return bool Is Font SFNT format
     */
    public function isFontSfnt(): bool
    {
        return $this->mime->format === "font-sfnt";
    }
}