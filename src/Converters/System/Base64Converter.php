<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\System;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\System\Base64;


final class Base64Converter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Base64::class, [
            '' => static function (string $value): Base64 {
                return Base64::fromBase64String($value);
            },
        ]);
    }
}
