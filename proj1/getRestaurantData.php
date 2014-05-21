<?php
require_once 'startup.php';

$data = new Data('restaurants.csv');
header('Content-Type: application/json; charset=utf-8');
echo $data->getJson();
