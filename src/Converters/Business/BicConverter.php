<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Business;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Business\Bic;


final class BicConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(Bic::class, [
            '' => static function (string $value): Bic {
                return Bic::fromString($value);
            },
        ]);
    }
}
