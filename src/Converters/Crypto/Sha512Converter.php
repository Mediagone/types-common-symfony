<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Crypto;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Crypto\Sha512;


final class Sha512Converter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Sha512::class, [
            '' => static function (string $value): Sha512 {
                return Sha512::fromHash($value);
            },
        ]);
    }
}
