<?php

namespace Sherpa\Core\files;

class Audio extends File
{
    /**
     * (mirror method)
     * @return bool Is MPEG/MP3 format
     * @see Audio::isMpeg()
     */
    public function isMp3(): bool
    {
        return $this->isMpeg();
    }

    /**
     * @return bool Is MPEG (audio) format
     */
    public function isMpeg(): bool
    {
        return $this->mime->format === "mpeg";
    }

    /**
     * @return bool Is WAV format
     */
    public function isWav(): bool
    {
        return $this->mime->format === "mpeg";
    }

    /**
     * @return bool Is OGG format
     */
    public function isOgg(): bool
    {
        return $this->mime->format === "mpeg";
    }

    /**
     * @return bool Is AAC format
     */
    public function isAac(): bool
    {
        return $this->mime->format === "aac";
    }

    /**
     * @return bool Is FLAC format
     */
    public function isFlac(): bool
    {
        return $this->mime->format === "flac";
    }

    /**
     * @return bool Is WEBM format
     */
    public function isWebm(): bool
    {
        return $this->mime->format === "webm";
    }

    /**
     * @return bool Is X-MS-WMA format
     */
    public function isXmsWma(): bool
    {
        return $this->mime->format === "x-ms-wma";
    }

    /**
     * @return bool Is X-WAV format
     */
    public function isXWav(): bool
    {
        return $this->mime->format === "x-wav";
    }

    /**
     * @return bool Is X-AIFF format
     */
    public function isXAiff(): bool
    {
        return $this->mime->format === "x-aiff";
    }
}