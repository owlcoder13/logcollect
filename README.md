<h1>LogCollect</h1>

The library works in conjunction with the [log-collect.com](https://log-collect.com) server. In order to connect the library you need to register on the service.
You need register account, add your site in the settings. 

## Using

```php

use Owlcoder\LogCollect\LogCollect;

$api = new LogCollect($youApiKey);
$api->error('some message', 'stack trace here')

```