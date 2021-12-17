<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Hex;


final class HexConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Hex::class, [
            '' => static function (string $value): Hex {
                return Hex::fromString($value);
            },
        ]);
    }
}
