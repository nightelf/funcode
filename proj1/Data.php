<?php
class Data {
	
	/**
	 * The path.
	 * @var string
	 */
	private $_path;
	
	/**
	 * The json path.
	 * @var string
	 */
	private $_jsonPath;
	
	/**
	 * The restaurant data in json format.
	 * @var array
	 */
	private $_jsonData;
	
	/**
	 * Constructor.
	 */
	public function __construct($path) {
		
		$this->_path = $path;
		if (!$this->_loadCached()) {
			$this->_parse();
			$this->_cache();
		}
	}
	
	/**
	 * Opens and parses the file data.
	 * @return boolean
	 */
	private function _loadCached() {

		$isCached = false;
		$filepath = $this->_getJsonPath();

		if (file_exists($filepath) && filemtime($filepath) > strtotime('-1 hour')) {
			$json = file_get_contents($filepath, 'w+');
			$length = strlen($json);
			if ($length && $json[0] === '[' && $json[$length - 1] === ']') {
				$this->_jsonData = $json;
				$isCached = true;
			}
		}
		return $isCached;
	}
	
	/**
	 * Saves / caches the json file data.
	 */
	private function _cache() {
		file_put_contents($this->_getJsonPath(), $this->_jsonData);
	}
	
	/**
	 * Opens and parses the file data.
	 */
	private function _parse() {
		$result = array();
		$rowCount = 0;
		$fp = fopen($this->_path, 'r');
		list($restaurantTitle, $cuisineTitle) = fgetcsv($fp, 1024);
		while ($data = fgetcsv($fp, 1024)) {
			$result[$rowCount][$restaurantTitle] = $data[0];
			$result[$rowCount++][$cuisineTitle] = $data[1];
		}
		
		$this->_jsonData = json_encode($result);
	}
	
	/**
	 * Gets the restaurant data.
	 * @return array
	 */
	private function _getJsonPath() {
	
		if (null === $this->_jsonPath) {
			$parts = pathinfo($this->_path);
			$filename = $parts['filename'] . ".json";
			$this->_jsonPath = ($parts['dirname'] ? $parts['dirname'] . "/" : '') . $filename;
		}
		return $this->_jsonPath;
	}
	
	/**
	 * Gets the restaurant data as a JSON string.
	 * @return string JSON
	 */
	public function getJson() {
		
		return $this->_jsonData;
	}
}