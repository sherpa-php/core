<?php

namespace Sherpa\Core\validation;

use Sherpa\Core\router\Request;
use Sherpa\Core\validation\enums\Response;

/**
 * Rule main class.
 * <p>
 *     Implements all rule utilities methods.
 * </p>
 */
abstract class Rule
{
    public private(set) bool $response;

    /**
     * Used by Validator for verifying to get state.
     *
     * @param Request $request
     * @return bool|Response Rule response state
     */
    public abstract function handle(Request $request): bool|Response;

    /**
     * @return string Rule error message
     */
    public abstract function getError(): string;
}