# Remote SFTP/SSH for Laravel

[![Total Downloads](https://img.shields.io/packagist/dt/nulvem/remote.svg)](https://packagist.org/packages/nulvem/remote)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/nulvem/remote.svg)](https://packagist.org/packages/nulvem/remote)
[![License](https://img.shields.io/packagist/l/nulvem/remote.svg)](https://packagist.org/packages/nulvem/remote)

Remote is an SSH and SFTP connection package for the Laravel Framework. Our elegant solution simplifies even complex tasks with familiar Blade syntax. Experience easy, secure connections without tedious setup.

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

```php
use Nulvem\Remote\Facades\Remote;

$remote = Remote::ssh(host: '0.0.0.0');

$remote->run(script: 'hello-world');
```

If necessary, it is possible to change the default host port:

```php
use Nulvem\Remote\Facades\Remote;

$remote = Remote::ssh(
    host: '0.0.0.0',
    port: 2000
);

$remote->run(script: 'hello-world');
```

There is no default timeout, scripts may run forever, if necessary, it is possible to change the default host timeout:

```php
use Nulvem\Remote\Facades\Remote;

$remote = Remote::ssh(
    host: '0.0.0.0',
    timeout: 20
);

$remote->run(script: 'hello-world');
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
$remote = Remote::ssh(host: '0.0.0.0');

$remote->run(
    script: 'hello-world',
    data: [
        'name' => 'John Doe',
        'dir' => '/var/www/html'
    ]
)
```

#### SSH output

```php
$remote = Remote::ssh(host: '0.0.0.0');

$execution = $remote->run(script: 'hello-world');

$execution->output();

$execution->success();

$execution->failed();
```

> **Warning**
>
> Do not remove the last line `Remote script 'SCRIPT_NAME' finished` on script files, if removed the `success()` and `failed()` methods of the output will not work correctly.

### SFTP

#### Downloading files

```php
use Nulvem\Remote\Facades\Remote;

$remote = Remote::sftp(host: '0.0.0.0');

$remote->get(
    from: '/root/sample.json',
    to: storage_path('sample.json')
);
```

#### Uploading files

```php
use Nulvem\Remote\Facades\Remote;

$remote = Remote::sftp(host: '0.0.0.0');

$remote->put(from: storage_path('sample.json'));
```

By default the `/root` path will be used, if you want to use a custom path:

```php
use Nulvem\Remote\Facades\Remote;

$remote = Remote::sftp(host: '0.0.0.0');

$remote->put(
    from: storage_path('sample.json'),
    to: '/var/www/html'
);
```
#### Multiple actions on the same connection

```php
use Nulvem\Remote\Facades\Remote;

$remote = Remote::sftp(host: '0.0.0.0');

$remote->get(
    from: '/root/sample.json',
    to: storage_path('sample.json')
);

someLogicToChangeSampleFile();

$remote->put(from: storage_path('sample.json'));
```

#### SFTP output

```php
$remote = Remote::ssh(host: '0.0.0.0');

$remote->put(from: storage_path('sample.json'));

$execution->success();

$execution->failed();
```

## Security

If you've found a bug regarding security please mail [tech@nulvem.com.br](mailto:tech@nulvem.com.br) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
