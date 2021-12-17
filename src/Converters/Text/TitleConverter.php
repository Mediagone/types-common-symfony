<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Text;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Text\Title;


final class TitleConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Title::class, [
            '' => static function (string $value): Title {
                return Title::fromString($value);
            },
        ]);
    }
}
