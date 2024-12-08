<?php

namespace Sherpa\Core\validation\enums;

enum Response
{
    case ACCEPT;
    case DENY;

    public static function from(bool $value): self
    {
        return match ($value)
        {
            true => Response::ACCEPT,
            default => Response::DENY,
        };
    }
}
