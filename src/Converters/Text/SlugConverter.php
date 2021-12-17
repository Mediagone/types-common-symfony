<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Text\Slug;


final class SlugConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Slug::class, [
            '' => static function (string $value): Slug {
                return Slug::fromString($value);
            },
        ]);
    }
}
