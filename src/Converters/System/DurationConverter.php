<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Duration;


final class DurationConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Duration::class, [
            '' => static function (string $value): Duration {
                return Duration::fromSeconds((int)$value);
            },
        ]);
    }
}
