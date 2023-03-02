# Remote SCP/SSH for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nulvem/remote.svg?style=flat-square)](https://packagist.org/packages/nulvem/remote)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/nulvem/remote/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nulvem/remote/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/nulvem/remote/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/nulvem/remote/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nulvem/remote.svg?style=flat-square)](https://packagist.org/packages/nulvem/remote)

Project description...

## Installation

Install the composer package:

```bash
composer require nulvem/remote
```

Publish the configuration file:

```bash
artisan vendor:publish --provider="Nulvem\Remote\RemoteServiceProvider"
```

### Configuration

### Private key file

You can put your private key anywhere in the project, just point the key path in the file `/config/remote.php`:

```php
[
    'auth' => [
        'key_path' => env('REMOTE_KEY_PATH', storage_path('id_rsa')),
    ],
];
```

The default path is `/storage/id_rsa`.

### Default username

The default username is `root`, if you want to change it just add the following variable in the `.env` file:

```dotenv
REMOTE_USERNAME=dummy
```

### Logging

If you want the log of all executions to be saved, just add the desired channel in the `.env` file.

```dotenv
REMOTE_LOG_CHANNEL=remote
```

It is recommended to add the following channel in the file `/config/logging.php`:

```php
[
    'channels' => [
        'remote' => [
            'driver' => 'daily',
            'path' => storage_path('logs/remote.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],
    ],
]
```

## Usage

### SSH

#### Generating scripts

To generate a new remote script use the following command:

```bash
php artisan make:remote-script hello-world
```

A file called `hello-world.blade.php` will be generated inside the `/app/Scripts` folder.

If you want to change the default scripts folder, just change the `scripts_path` property inside the file `/config/remote.php`.

#### Executing scripts

There are two methods of running an SSH script:

```php
use Nulvem\Remote\Facades\Remote;
use Nulvem\Remote\Facades\Ssh;

Remote::ssh('0.0.0.0')->run('hello-world');

Ssh::on('0.0.0.0')->run('hello-world');
```

If necessary, it is possible to pass any parameters to the SSH script:

```bash
echo "Remote script 'install' started"

echo "Hello, my name is {{ $name }}!"
echo "I will list for you the files in the {{ $dir }} directory..."
pwd

echo "Remote script 'install' finished"
```

```php
Remote::ssh('0.0.0.0')
    ->run('hello-world', [
        'name' => 'John Doe',
        'dir' => '/var/www/html'
    ]);
```

#### Scripts outputs

```php
$connection = Remote::ssh('0.0.0.0')->run('hello-world');

$connection->output();

$connection->success();

$connection->failed();
```

> **Warning**
>
> Do not remove the last line `Remote script 'SCRIPT_NAME' finished`, if removed the `success()` and `failed()` methods of the output will not work correctly.

### SCP

SCP is not implemented yet.

## Security

If you've found a bug regarding security please mail [tech@nulvem.com.br](mailto:tech@nulvem.com.br) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
