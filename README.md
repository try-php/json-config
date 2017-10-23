# json-config

> Read `.json` files as config.

## Install

```bash
$ composer require try/json-config
```

## Usage

```php
<?php
require_once '/path/to/autoload.php';

use function TryPhp\jsonConfig;

$config = jsonConfig(__DIR__ . '/some.json');
$somethingNested = $config->get('first_lvl.second_lvl.value');
```

## API

### Functions

#### `jsonConfig($path)`

Function to load an return a `.json` file as accessable config. (Will return a `class@anonymous` object)

##### Arguments

| Argument | Type | Description |
|---|---|---|
| $path | `string` | Path to the `.json` file that should be read as a config. |

##### Return

API description of the returned object.

###### Methods

| Method | Arguments | Description |
|---|---|---|
| get($identifier, $seperator) | `$identifier` (string)(required), `$seperator` (string)(default: `.`) | Method to retrieve nested config entries more easily. |

###### Properties

| Property | Type | Description |
|---|---|---|
| $config | `\stdClass` | Property that contains the config as loaded by `json_decode`. |

## License

GPL-2.0 © Willi Eßer