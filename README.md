# laracvr

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


A simple Laravel CVR wrapper for the danish CVR API.


## Install

Via Composer

``` bash
$ composer require sh4dw/laracvr
```
## Config
``` bash
Add the following to your .env file
CVR_USER=<CVR USERNAME>
CVR_PASSWORD=<CVR PASSWORD>
```

## Usage
Lookup a CVR with the following example (query could be any valid Elasticseach format).

Read more: [Virk CVR documentation](http://datahub.virk.dk/dataset/system-til-system-adgang-til-cvr-data)
``` php
use Sh4dw\Laracvr\CVRClient;

$query = [
    'term' => [
    'cvrNummer' =>  <A VALID CVR>
    ]
];

$response = CVRClient::request($query);
return $response;
```

### Response format:
``` javascript
{
    'millis': 2, // Execution time in millis
    'timedOut': false, // If timed out at the API endpoint
    'totalHits': 1, //Number of hits found (results)
    'data': [] //array containing all data for the CVR record
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

[ico-version]: https://img.shields.io/packagist/v/sh4dw/laracvr.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/sh4dw/laracvr/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/sh4dw/laracvr.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/sh4dw/laracvr.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sh4dw/laracvr.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sh4dw/laracvr
[link-travis]: https://travis-ci.org/sh4dw/laracvr
[link-scrutinizer]: https://scrutinizer-ci.com/g/sh4dw/laracvr/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/sh4dw/laracvr
[link-downloads]: https://packagist.org/packages/sh4dw/laracvr
[link-author]: https://github.com/sh4dw
[link-contributors]: ../../contributors
