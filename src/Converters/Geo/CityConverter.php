<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Geo\City;


final class CityConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(City::class, [
            '' => static function (string $value): City {
                return City::fromString($value);
            },
        ]);
    }
}
