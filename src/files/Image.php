<?php

namespace Sherpa\Core\files;

class Image extends File
{
    /**
     * (mirror method)
     * @return bool Is JPEG format
     * @see Image::isJpeg()
     */
    public function isJpg(): bool
    {
        return $this->isJpeg();
    }

    /**
     * @return bool Is JPEG format
     */
    public function isJpeg(): bool
    {
        return $this->mime->format === "jpeg";
    }

    /**
     * @return bool Is PNG format
     */
    public function isPng(): bool
    {
        return $this->mime->format === "png";
    }

    /**
     * @return bool Is GIF format
     */
    public function isGif(): bool
    {
        return $this->mime->format === "gif";
    }

    /**
     * @return bool Is BMP format
     */
    public function isBmp(): bool
    {
        return $this->mime->format === "bmp";
    }

    /**
     * @return bool Is WEBP format
     */
    public function isWebp(): bool
    {
        return $this->mime->format === "webp";
    }

    /**
     * @return bool Is TIFF format
     */
    public function isTiff(): bool
    {
        return $this->mime->format === "tiff";
    }

    /**
     * @return bool Is SVG format
     */
    public function isSvg(): bool
    {
        return $this->mime->format === "svg+xml";
    }

    /**
     * @return bool Is X-ICON format
     */
    public function isXIcon(): bool
    {
        return $this->mime->format === "x-icon";
    }

    /**
     * @return bool Is HEIF format
     */
    public function isHeif(): bool
    {
        return $this->mime->format === "heif";
    }

    /**
     * @return bool Is HEIC format
     */
    public function isHeic(): bool
    {
        return $this->mime->format === "heic";
    }
}