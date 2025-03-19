<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\models\Model;

class Session extends Model
{
    public function __construct(array $public, array $private)
    {
        parent::__construct($public, $private);

        self::setTable("sherpa_sessions");
    }
}