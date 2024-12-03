<?php

namespace Sherpa\Core\views;

class SherpaEngine
{
    public static function prepare(string $templatePath): SherpaRendering
    {
        return new SherpaRendering($templatePath);
    }
}