<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Date;


final class DateConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Date::class, [
            '' => static function (string $value): Date {
                return Date::fromString($value);
            },
        ]);
    }
}
