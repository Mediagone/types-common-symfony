<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Geo;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Geo\Address;


final class AddressConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Address::class, [
            '' => static function (string $value): Address {
                return Address::fromString($value);
            },
        ]);
    }
}
