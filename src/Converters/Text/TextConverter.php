<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Text\Text;


final class TextConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Text::class, [
            '' => static function (string $value): Text {
                return Text::fromString($value);
            },
        ]);
    }
}
