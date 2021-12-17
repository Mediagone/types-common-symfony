<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Count;


final class CountConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Count::class, [
            '' => static function (string $value): Count {
                return Count::fromInt((int)$value);
            },
        ]);
    }
}
