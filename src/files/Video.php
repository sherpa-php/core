<?php

namespace Sherpa\Core\files;

/**
 * Class representing a video,
 * inherited from File class.
 * <p>
 *     Used to deal with video files.
 * </p>
 */
class Video extends File
{
    /**
     * (mirror method)
     * @return bool Is MP4 format
     * @see Video::isMpeg()
     */
    public function isMp4(): bool
    {
        return $this->isMpeg();
    }

    /**
     * @return bool Is MPEG (video) format
     */
    public function isMpeg(): bool
    {
        return $this->mime->format === "mp4";
    }

    /**
     * @return bool Is AVI format
     */
    public function isAvi(): bool
    {
        return $this->mime->format === "avi";
    }

    /**
     * @return bool Is QUICKTIME format
     */
    public function isQuicktime(): bool
    {
        return $this->mime->format === "quicktime";
    }

    /**
     * @return bool Is WEBM format
     */
    public function isWebm(): bool
    {
        return $this->mime->format === "webm";
    }

    /**
     * @return bool Is X-MS-WMV format
     */
    public function isXMsWmv(): bool
    {
        return $this->mime->format === "x-ms-wmv";
    }

    /**
     * @return bool Is X-FLV format
     */
    public function isXFlv(): bool
    {
        return $this->mime->format === "x-flv";
    }

    /**
     * @return bool Is 3GPP format
     */
    public function is3gpp(): bool
    {
        return $this->mime->format === "3gpp";
    }

    /**
     * @return bool Is 3GPP2 format
     */
    public function is3gpp2(): bool
    {
        return $this->mime->format === "3gpp2";
    }

    /**
     * @return bool Is X-MATROSKA format
     */
    public function isXMatroska(): bool
    {
        return $this->mime->format === "x-matroska";
    }
}