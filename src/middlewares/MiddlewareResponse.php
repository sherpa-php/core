<?php

namespace Sherpa\Core\middlewares;

enum MiddlewareResponse
{
    case ABORT;
    case CONTINUE;
}
