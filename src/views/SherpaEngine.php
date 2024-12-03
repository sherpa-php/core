<?php

namespace Sherpa\Core\views;

/**
 * Sherpa Engine utility class.
 */
class SherpaEngine
{
    public static function prepare(string $templatePath): SherpaRendering
    {
        return new SherpaRendering($templatePath);
    }
}