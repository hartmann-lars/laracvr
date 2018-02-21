# LaraCVR

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Lars Hartmann``` ```sh4dw``` ```https://github.com/sh4dw``` ```lh@purebyte.dk``` ```sh4dw``` ```LaraCVR``` ```Wrapper for danish CVR API``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

A CVR wrapper for the


## Install

Via Composer

``` bash
$ composer require sh4dw/LaraCVR
```

## Usage
Lookup a CVR with the following example:
``` php
use sh4dw\LaraCVR\CVRClient;

$query = [
    'term' => [
    'cvrNummer' =>  <A VALID CVR>
    ]
];

$response = CVRClient::request($query);
return $response;
```

### Response format:
``` json
{
    'millis': <Execution time in millis>,
    'timedOut': <true/false>,
    'totalHits': <Number of hits found (results)>,
    'data': <array containing all data for the CVR record>
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email lh@purebyte.dk instead of using the issue tracker.

## Credits

- [Lars Hartmann][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sh4dw/LaraCVR.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/sh4dw/LaraCVR/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/sh4dw/LaraCVR.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/sh4dw/LaraCVR.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sh4dw/LaraCVR.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sh4dw/LaraCVR
[link-travis]: https://travis-ci.org/sh4dw/LaraCVR
[link-scrutinizer]: https://scrutinizer-ci.com/g/sh4dw/LaraCVR/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/sh4dw/LaraCVR
[link-downloads]: https://packagist.org/packages/sh4dw/LaraCVR
[link-author]: https://github.com/sh4dw
[link-contributors]: ../../contributors
