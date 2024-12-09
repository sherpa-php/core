<?php

namespace Sherpa\Core\validation;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\exceptions\validator\RuleDoesNotExistException;
use Sherpa\Core\router\Request;
use Sherpa\Core\validation\enums\Response;

class Validator
{
    private array $data;
    private array $rules;

    /** Validation errors bag. */
    private array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    /**
     * Adds an error to errors bag
     * using input's name as key and message.
     *
     * @param string $input Input's name attribute
     * @param string $message Error message
     * @return $this
     */
    public function addError(string $input, string $message): self
    {
        $this->errors[$input] = $message;

        return $this;
    }

    /**
     * Get all or specific input's errors.
     *
     * @param string|null $input
     * @return array Filtered errors bag
     */
    public function errors(?string $input = null): array
    {
        return $input === null
            ? $this->errors[$input] ?? []
            : $this->errors;
    }

    /**
     * Validates inputs data using provided rules.
     *
     * @param Request $request
     * @param array $rules
     * @return self
     */
    public static function run(Request $request, array $rules): self
    {
        $validator = new self($request->data(), $rules);

        foreach ($rules as $rule)
        {
            if (!$rule["response"])
            {
                $validator->addError(
                    $rule["data"],
                    $rule["errorMessage"]);
            }
        }

        return $validator;
    }
}