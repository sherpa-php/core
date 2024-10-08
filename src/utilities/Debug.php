<?php

namespace Sherpa\Core\Utilities;

class Debug
{
    public static function dump(mixed ...$args): void
    {
        foreach ($args as $arg)
        {
            $backtrace = debug_backtrace();
            self::renderDumping($backtrace, $arg);
        }
    }

    private static function renderDumping(array $backtrace, mixed $value): void
    {
        echo "
        <div class='debug-container'>
        ";

        var_dump($value);

        echo "
        </div>
        
        <style>
            .debug-container {
                border: solid 2px orange;
                border-radius: 15px;
                
                background-color: #393939;
                
                padding: 10px;
            }
            .debug-container::before {
                content: '';
            }
        </style>
        ";
    }
}