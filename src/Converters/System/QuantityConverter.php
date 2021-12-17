<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Quantity;


final class QuantityConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Quantity::class, [
            '' => static function (string $value): Quantity {
                return Quantity::fromInt((int)$value);
            },
        ]);
    }
}
