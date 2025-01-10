<?php

namespace Sherpa\Core\core\naming;

use Symfony\Component\String\Inflector\EnglishInflector;
use function Symfony\Component\String\u;

class Name
{
    public static function getDBNameFromModel(string $model): string
    {
        $english = new EnglishInflector();

        $modelName = explode('\\', basename($model));
        $modelName = u(array_pop($modelName))->lower();

        return $english->pluralize($modelName)[0]
            ?? $modelName->toString();
    }

    public static function singularize(string $expression): string
    {
        $english = new EnglishInflector();

        return $english->singularize($expression)[0]
            ?? $expression;
    }
}