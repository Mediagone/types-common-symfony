<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Age;


final class AgeConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Age::class, [
            '' => static function (string $value): Age {
                return Age::fromInt((int)$value);
            },
        ]);
    }
}
