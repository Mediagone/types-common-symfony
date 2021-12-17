<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Web;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Web\UrlHost;


final class UrlHostConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(UrlHost::class, [
            '' => static function (string $value): UrlHost {
                return UrlHost::fromString($value);
            },
        ]);
    }
}
