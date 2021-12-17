<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Text\NameDigit;


final class NameDigitConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(NameDigit::class, [
            '' => static function (string $value): NameDigit {
                return NameDigit::fromString($value);
            },
        ]);
    }
}
