<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\models\Model;

class Session extends Model
{
    public static ?string $table = "sherpa_sessions";
}