<?php

namespace Sherpa\Core\debugging;

use Sherpa\Ui\rendering\UI;

class DebugUI extends UI
{
    protected string $layoutPath
        = __DIR__ . "/rendering/dump.html";

    protected ?string $stylesheetPath
        = __DIR__ . "/rendering/dump.css";

    private string $dumping;

    public function __construct(mixed $dumping)
    {
        parent::__construct("Debug", "Debug");

        $this->dumping = self::varDumpToString($dumping);
    }

    protected function props(): array
    {
        return [
            "Dumping" => $this->dumping,
        ];
    }


    /**
     * Record var_dump() result
     * and return it as string.
     *
     * @param mixed $dumping Value to dump
     * @return string Dump as string from var_dump()
     */
    private static function varDumpToString(mixed $dumping): string
    {
        ob_start();
        var_dump($dumping);

        return ob_get_clean();
    }
}