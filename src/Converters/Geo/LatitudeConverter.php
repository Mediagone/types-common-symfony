<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Geo\Latitude;


final class LatitudeConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Latitude::class, [
            '' => static function (string $value): Latitude {
                return Latitude::fromFloat((float)$value);
            },
        ]);
    }
}
