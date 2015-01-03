<?php
require_once 'startup.php';

$data = new Data('restaurants.csv');
# this is doing stupid stuff
header('Content-Type: application/json; charset=utf-8');
echo $data->getJson();
