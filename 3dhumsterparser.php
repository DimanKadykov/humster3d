<?php

require_once 'phpQuery/phpQuery.php';

function parseAllLinks()
{
    $htmlcontent = file_get_contents('http://humster3d.com/vehicle-catalogue/');
    $document = phpQuery::newDocument($htmlcontent);
    
    $links = $document->find('a');
    
    foreach($links as $link) {
        $href = $link->getAttribute('href');
        
        if(preg_match('|http://humster3d.com/\d{4}|', $href)) {
            echo $link->getAttribute('href') . PHP_EOL;
            // parseItemInformation($fp, $link->getAttribute('href'));
            
            system('php 3dhumster_parse_link.php ' . $link->getAttribute('href'));
        }
    }
}

parseAllLinks();