<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Geo\Country;


final class CountryConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Country::class, [
            '' => static function (string $value): Country {
                return Country::fromAlpha3($value);
            },
        ]);
    }
}
