# Master API Client

The bc-automotive/master-api-client package is a library that eases integration of the [bFlash Master API](https://www.bflash.eu) in your site.

## Installation

Install the package via composer:

``` bash
composer require bc-automotive/master-api-client
```

## Usage

The api uses authentication using a bearer token.  Contact [bFlash support](support@bflash.eu) to request your authentication token.

### Encrypt a slave file:

```php
use \BcAutomotive\MasterApiClient\MasterApiClient;

$client = new MasterApiClient($apiKey);

$data = file_get_contents('/path/to/data.bdc');
$encrypted = $client->encrypt($data, $slaveName);
file_put_contents('/path/to/data.sbdc', $encrypted['data']);

```

### Decrypt a slave file:

```php
use \BcAutomotive\MasterApiClient\MasterApiClient;

$client = new MasterApiClient($apiKey);

$data = file_get_contents('/path/to/data.sbdc');
$decrypted = $client->decrypt($data);
file_put_contents('/path/to/data.sbdc', $decrypted['data']);

```

### Laravel Integration

The package has a laravel service provider and facade to ease integration, so after including the package inside your laravel project, you can add the key to the `.env` file

```
MASTER_API_KEY=your_key_here
```

And use the facade:

```php
use MasterApiClient;

$encrypted = MasterApiClient::encrypt($data, $slaveName);
$decrypted = MasterApiClient::decrypt($data);

```

### Exceptions

The `MasterApiClient` class is a small wrapper around the `Guzzle` http client library, so this class can throw all
regular `Guzzle` exceptions as well.  You can file the [Guzzle docs here](https://docs.guzzlephp.org/en/stable/).

## License
[MIT](./LICENSE.md)
