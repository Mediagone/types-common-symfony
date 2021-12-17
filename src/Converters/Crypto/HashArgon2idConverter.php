<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Crypto;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Crypto\HashArgon2id;


final class HashArgon2idConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(HashArgon2id::class, [
            '' => static function (string $value): HashArgon2id {
                return HashArgon2id::fromHash($value);
            },
        ]);
    }
}
