<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Graphics;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Graphics\Color;

final class ColorConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Color::class, [
            '' => static function (string $value): Color {
                return Color::fromString($value);
            },
        ]);
    }
}
