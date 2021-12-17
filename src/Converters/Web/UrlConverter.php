<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Web;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Web\Url;


final class UrlConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Url::class, [
            '' => static function (string $value): Url {
                return Url::fromString($value);
            },
        ]);
    }
}
