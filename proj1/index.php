<?php
require_once 'startup.php';
header('Content-Type: text/html; charset=utf-8');
$vars = array(
	'companyName' => "Fidel's Restaurant Guide",
);
Renderer::display('index.tpl', $vars);