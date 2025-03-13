<?php

namespace Sherpa\Core\containment;

use Sherpa\Core\security\Security;

/**
 * Bag main class.
 * <p>
 *     Permits to contain
 * </p>
 */
class Bag
{
    private array $content;

    public function __construct(array $content = [])
    {
        $this->content = $content;
    }

    /**
     * @return array All items from the bag
     */
    public function all(): array
    {
        return $this->content;
    }

    /**
     * Get bag's item by its key
     *
     * @param string $key
     * @return mixed Item's value
     */
    public function get(string $key): mixed
    {
        return $this->has($key)
            ? $this->content[$key]
            : null;
    }

    /**
     * Get bag's item by its value,
     * using callback function.
     *
     * @param callable $cb Callback function
     * @return mixed
     */
    public function getByElement(callable $cb): mixed
    {
        return array_find($this->content, $cb);
    }

    /**
     * Return if the provided key
     * is used in the bag.
     *
     * @param string $key
     * @return mixed
     */
    public function has(string $key): mixed
    {
        return array_key_exists($key, $this->content);
    }

    /**
     * Add an item to the bag.
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function add(string $key, mixed $value): static
    {
        $this->content[$key] = $value;

        return $this;
    }

    /**
     * Remove an item from the bag
     * using its key.
     *
     * @param string $key
     * @return $this
     */
    public function remove(string $key): static
    {
        if ($this->has($key))
        {
            unset($this->content[$key]);
        }

        return $this;
    }

    /**
     * Rename an item's key.
     *
     * @param string $current Current item's key
     * @param string $new New item's key
     * @return $this
     */
    public function rename(string $current, string $new): static
    {
        if ($this->has($current))
        {
            $value = $this->get($current);
            unset($this->content[$current]);
            $this->add($new, $value);
        }

        return $this;
    }

    /**
     * @return bool Is the bag empty
     */
    public function isEmpty(): bool
    {
        return !count($this->content);
    }

    /**
     * @return bool Is the bag not empty
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    /**
     * @return $this Sanitized version of the current bag
     */
    public function sanitize(): static
    {
        return new Bag(array_map(function ($element)
        {
            return Security::secureData($element);
        }, $this->all()));
    }

    /**
     * @return int Bag's elements count
     */
    public function count(): int
    {
        return count($this->content);
    }
}