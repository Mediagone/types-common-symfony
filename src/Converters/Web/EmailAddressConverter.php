<?php declare(strict_types=1);

namespace Mediagone\Symfony\Types\Common\Converters\Web;

use Mediagone\Symfony\PowerPack\Converters\ValueParamConverter;
use Mediagone\Types\Common\Web\EmailAddress;


final class EmailAddressConverter extends ValueParamConverter
{
    public function __construct()
    {
        parent::__construct(EmailAddress::class, [
            '' => static function (string $value): EmailAddress {
                return EmailAddress::fromString($value);
            },
        ]);
    }
}
