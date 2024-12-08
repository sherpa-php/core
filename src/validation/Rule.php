<?php

namespace Sherpa\Core\validation;

use Sherpa\Core\router\Request;
use Sherpa\Core\validation\enums\Response;

/**
 * Rule interface.
 * <p>
 *     Defines all rule utilities methods.
 * </p>
 */
interface Rule
{
    /**
     * Used by Validator for verifying to get state.
     *
     * @param Request $request
     * @return bool|Response Rule response state
     */
    public function handle(Request $request): bool|Response;

    /**
     * @return string Rule error message
     */
    public function getError(): string;
}