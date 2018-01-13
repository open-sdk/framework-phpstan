# Framework PHPStan extension - Open SDK

[![Latest Release](https://img.shields.io/github/release/open-sdk/framework-phpstan/all.svg?style=flat-square)](https://github.com/open-sdk/framework-phpstan/releases)
[![Build Status](https://img.shields.io/travis/open-sdk/framework-phpstan/master.svg?style=flat-square)](https://travis-ci.org/open-sdk/framework-phpstan)
[![Total Downloads](https://img.shields.io/packagist/dt/open-sdk/framework-phpstan.svg?style=flat-square)](https://packagist.org/packages/open-sdk/framework-phpstan)

This package provides some extensions of the [Open SDK framework][link-opensdk] for [PHPStan][link-phpstan] to improve the overall developer's experience.

## Features

- Dynamic type for [OpenSdk\Resource\Manager::asModel()](#dynamic-type-resource-managers-asmodel)

### Dynamic type: resource manager's `asModel`

`OpenSdk\Resource\Manager::asModel()` returns the response value, wrapped in a resource model.
The model instance can either be the default model type or a custom subclass.

## Usage

To use this extension for [PHPStan][link-phpstan] add it to the requirements within [Composer][link-composer].

``` bash
$ composer require --dev open-sdk/framework-phpstan
```

And add it to the [PHPStan][link-phpstan] configuration.

```
includes:
	- vendor/open-sdk/framework-phpstan/extension.neon
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-composer]: https://github.com/composer/composer
[link-opensdk]: https://github.com/open-sdk/framework
[link-phpstan]: https://github.com/phpstan/phpstan
