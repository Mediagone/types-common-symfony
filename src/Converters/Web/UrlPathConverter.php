<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Web;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Web\UrlPath;


final class UrlPathConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(UrlPath::class, [
            '' => static function (string $value): UrlPath {
                return UrlPath::fromString($value);
            },
        ]);
    }
}
