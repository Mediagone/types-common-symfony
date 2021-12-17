<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Text\TextMedium;


final class TextMediumConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(TextMedium::class, [
            '' => static function (string $value): TextMedium {
                return TextMedium::fromString($value);
            },
        ]);
    }
}
