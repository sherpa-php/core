<?php

class SherpaEngine
{
    public static function prepare(string $templatePath): SherpaRendering
    {
        return new SherpaRendering($templatePath);
    }
}