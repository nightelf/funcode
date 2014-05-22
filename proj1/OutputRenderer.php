<?php
/**
 * Renders a template file.
 */
class OutputRenderer {

	/**
	 * Gets the restaurant data.
	 * @param string $path the path of the file to render.
	 * @param array $vars a map of keys to values.
	 * @return string
	 */
	public static function render($path, array $vars = array()) {
	
		extract($vars);
		ob_start();
		include $path;
		return ob_get_clean();
	}
	
	/**
	 * Gets the restaurant data.
	 * @param string $path the path of the file to render.
	 * @param array $vars a map of keys to values.
	 */
	public static function display($path, array $vars = array()) {
	
		echo static::render($path, $vars);
	}
}