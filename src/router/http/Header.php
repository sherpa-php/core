<?php

namespace Sherpa\Core\router\http;

use Sherpa\Core\containment\Bag;
use Sherpa\Core\router\exceptions\InvalidHeaderLocalesException;

/**
 * Request's headers class.
 * <p>
 *     For recording all request's headers.
 * </p>
 */
class Header extends Bag
{
    private const string LOCALES_REGEX
        = "/^[a-z]{2,3}(?:-[A-Z]{2,3})?(?:;q=0\.[0-9])?(?:,[a-z]{2,3}(?:-[A-Z]{2,3})?(?:;q=0\.[0-9])?)*$/";

    /**
     * @return Bag Request's locales bag
     * @throws InvalidHeaderLocalesException
     */
    public function locales(): Bag
    {
        if (!$this->isLocalesValid())
        {
            throw new InvalidHeaderLocalesException();
        }

        $localesHeader = $this->getLocalesAttribute();

        return new Bag(explode(',', $localesHeader))
            ->sanitize();
    }

    /**
     * @return bool Is request's locales' header attribute valid?
     */
    public function isLocalesValid(): bool
    {
        return preg_match(
            self::LOCALES_REGEX,
            $this->getLocalesAttribute());
    }

    /**
     * @return string Request's locales' header attribute
     */
    private function getLocalesAttribute(): string
    {
        return $this->get("Accept-Language") ?? "";
    }
}