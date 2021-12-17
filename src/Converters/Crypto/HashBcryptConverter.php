<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Crypto;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Crypto\HashBcrypt;


final class HashBcryptConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(HashBcrypt::class, [
            '' => static function (string $value): HashBcrypt {
                return HashBcrypt::fromHash($value);
            },
        ]);
    }
}
