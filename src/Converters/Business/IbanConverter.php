<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Business;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Business\Iban;


final class IbanConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Iban::class, [
            '' => static function (string $value): Iban {
                return Iban::fromString($value);
            },
        ]);
    }
}
