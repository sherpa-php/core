<?php

namespace Sherpa\Core\validation;

class ErrorBag
{
    public private(set) array $errors = [];

    /**
     * @return bool Is errors bag empty
     */
    public function isEmpty(): bool
    {
        return !count($this->errors);
    }

    /**
     * @return bool Is errors bag not empty
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * Adds an error to bag
     *
     * @param string $key
     * @param string $error
     * @return $this
     */
    public function add(string $key, string $error): self
    {
        $this->errors[$key] = $error;

        return $this;
    }

    /**
     * Removes error from bag by its key.
     *
     * @param string $key
     * @return $this
     */
    public function remove(string $key): self
    {
        if ($this->has($key))
        {
            unset($this->errors[$key]);
        }

        return $this;
    }

    /**
     * @param string $key Error's key
     * @return bool Is error key existing
     */
    public function has(string $key): bool
    {
        return isset($this->errors[$key]);
    }

    /**
     * @param string|null $key (optional) error's key
     * @return array|string|null Errors array or error value if exists
     */
    public function get(?string $key = null): array|string|null
    {
        return $key === null
            ? $this->errors
            : ($this->has($key)
                ? $this->errors[$key]
                : null);
    }
}