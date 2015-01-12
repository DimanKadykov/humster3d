<?php

require_once 'config.php';
require_once 'phpQuery/phpQuery.php';
require_once 'autoload.php';

$siteParser = new HumsterCatalogParser();

$siteParser->parseAllLinks();