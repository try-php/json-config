<?php
namespace TryPhp;

/**
 * Function to read a JSON file by path and return an accessable interface to get config values
 * @param string $path
 * @return class@anonymous
 */
function jsonConfig(string $path) {
	if (!file_exists($path)) {
		throw new \Exception("File `$path` does not exist.");
	}

	$loadedConfig = file_get_contents($path);

	return new class($loadedConfig, $path) {

		/**
		 * Contains the raw config
		 * @var \stdClass
		 */
		public $config;

		public function __construct(string $config, string $path) 
		{
			$this->config = json_decode($config);

			$lastError = json_last_error();
			if ($lastError) {
				throw new \Exception("File `$path` contains invalid JSON - Error code: $lastError");
			}
		}

		/**
		 * method to retrieve nested entries in the config
		 * @param  string $identifier
		 * @return mixed|null
		 */
		public function get(string $identifier, string $seperator = '.')
		{
			$branch = explode($seperator, $identifier);
			$previous = $this->config;

			foreach ($branch as $twig) {
				if (isset($previous->{$twig})) {
					$previous = $previous->{$twig};
					continue;
				} else {
					return null;
				}				
			}

			return $previous;
		}
	};
}