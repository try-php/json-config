<?php
require_once './vendor/autoload.php';

use function TryPhp\jsonConfig;


try {
	jsonConfig('./some/not-existent.json');
	trigger_error('test failed.', E_USER_ERROR);
} catch (\Exception $ex) {}

try {
	jsonConfig(__DIR__ . '/composer.json');	
} catch (\Exception $ex) {
	trigger_error('test failed.', E_USER_ERROR);
}

try {
	jsonConfig(__DIR__ . '/test/invalid.json');
	trigger_error('test failed.', E_USER_ERROR);
} catch (\Exception $ex) {}

$config = jsonConfig(__DIR__ . '/composer.json');
$existingValue = $config->get('autoload.files');

if (!is_array($existingValue)) {
	trigger_error('test failed.', E_USER_ERROR);
}

$notExistingValue = $config->get('autoload.unicorns');
if ($notExistingValue !== null) {
	trigger_error('test failed.', E_USER_ERROR);
}
