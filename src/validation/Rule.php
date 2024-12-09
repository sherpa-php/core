<?php

namespace Sherpa\Core\validation;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\exceptions\validator\RuleDoesNotExistException;
use Sherpa\Core\router\Request;
use Sherpa\Core\validation\enums\Response;

/**
 * Rule interface.
 * <p>
 *     Defines all rule utilities methods.
 * </p>
 */
class Rule
{
    /**
     * Used by Validator for verifying
     * and getting response state.
     *
     * @param Request $request
     * @param mixed $value
     * @param array $args
     * @return bool|Response Rule response state
     */
    public function handle(Request $request, mixed $value, array $args = []): bool|Response
    { return Response::ACCEPT; }

    /**
     * @return string Rule error message
     */
    public function getError(): string
    { return "Global Validator error."; }

    /**
     * Uses class rule.
     *
     * @param string $data Request data key
     * @param array $args (optional) arguments
     * @return array Rule response array
     */
    public static function use(string $data, array $args = []): array
    {
        $request = Request::current() ?? new Request();

        $rule = new self();

        $response = $rule
            ->handle(
                $request,
                $request->data($data));

        $responseBoolean = true;

        if (($response instanceof Response) && $response === Response::DENY
            || !$response)
        {
            $responseBoolean = false;
        }

        return [
            "data" => $data,
            "response" => $responseBoolean,
            "errorMessage" => $rule->getError(),
        ];
    }
}