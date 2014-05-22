<?php
ini_set('default_charset', 'utf-8');
date_default_timezone_set('America/Los_Angeles');
function my_loader ($class_name) {
    include $class_name . '.php';
}
spl_autoload_extensions('.php');
spl_autoload_register('my_loader');
