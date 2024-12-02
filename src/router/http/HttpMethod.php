<?php

namespace Sherpa\Core\router\http;

enum HttpMethod
{
    case GET;
    case POST;
    case HEAD;
    case PUT;
    case DELETE;
}
