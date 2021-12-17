<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Text\NameSpecial;


final class NameSpecialConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(NameSpecial::class, [
            '' => static function (string $value): NameSpecial {
                return NameSpecial::fromString($value);
            },
        ]);
    }
}
