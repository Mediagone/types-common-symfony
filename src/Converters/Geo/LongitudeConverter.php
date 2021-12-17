<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Geo\Longitude;


final class LongitudeConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Longitude::class, [
            '' => static function (string $value): Longitude {
                return Longitude::fromFloat((float)$value);
            },
        ]);
    }
}
