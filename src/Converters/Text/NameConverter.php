<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Text\Name;


final class NameConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Name::class, [
            '' => static function (string $value): Name {
                return Name::fromString($value);
            },
        ]);
    }
}
