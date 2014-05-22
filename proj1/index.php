<?php
require_once 'startup.php';
header('Content-Type: text/html; charset=utf-8');
$vars = array(
	'companyName' => "Fidel's Restaurant Guide",
    'baseUrl' => $_SERVER["REQUEST_URI"]
);
OutputRenderer::display('index.tpl', $vars);