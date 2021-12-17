# Types Common for Symfony

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE)

Provides Symfony param converters for "mediagone/types-common" package.


## Installation
This package requires **PHP 7.4+** and Symfony.

Add it as Composer dependency:
```sh
$ composer require mediagone/types-common-symfony
```

In order to use "mediagone/types-common" types as controller parameters, you must register the converters in your `services.yaml` by adding the following service declaration:
```yaml
services:

    Mediagone\Symfony\Types\Common\Converters\:
        resource: '../vendor/mediagone/types-common-symfony/src/Converters/'
```

## License

_Types Common for Symfony_ is licensed under MIT license. See LICENSE file.



[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-version]: https://img.shields.io/packagist/v/mediagone/types-common-symfony.svg
[ico-downloads]: https://img.shields.io/packagist/dt/mediagone/types-common-symfony.svg

[link-packagist]: https://packagist.org/packages/mediagone/types-common-symfony
[link-downloads]: https://packagist.org/packages/mediagone/types-common-symfony
