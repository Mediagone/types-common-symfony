<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\DateTimeUTC;


final class DateTimeUTCConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(DateTimeUTC::class, [
            '' => static function (string $value): DateTimeUTC {
                return DateTimeUTC::fromString($value);
            },
        ]);
    }
}
