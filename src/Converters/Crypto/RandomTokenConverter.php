<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Crypto;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Crypto\RandomToken;


final class RandomTokenConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(RandomToken::class, [
            '' => static function (string $value): RandomToken {
                return RandomToken::fromHexString($value);
            },
        ]);
    }
}
