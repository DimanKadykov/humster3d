<?php

require_once 'config.php';
require_once 'phpQuery/phpQuery.php';
require_once 'autoload.php';

$itemParser = new ItemParser(['BASE_PATH' => BASE_PATH]); 
$itemParser->parseItemInformation($argv[1]);