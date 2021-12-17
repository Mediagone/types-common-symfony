<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Binary;


final class BinaryConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Binary::class, [
            '' => static function (string $value): Binary {
                return Binary::fromString($value);
            },
        ]);
    }
}
