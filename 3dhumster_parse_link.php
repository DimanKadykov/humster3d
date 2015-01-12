<?php

require_once 'phpQuery/phpQuery.php';

class ItemParser
{
    private $basePath; 
    private $document;
    
    public function __construct($options) 
    {        
        if(isset($options['BASE_PATH'])) {
            $this->basePath = $options['BASE_PATH'];
        } else {
            throw new Exception('You must define BASE_PATH option');
        }
    }       
    
    public function parseItemInformation($itemUrl)
    {
        $modelPath = null;
        preg_match('|([^/]+)/$|', $itemUrl, $modelPath);
        $modelDirName = '';

        if(isset($modelPath[1])) {
            $modelDirName = $modelPath[1];
        } else {
            echo "strange link: " . $itemUrl . PHP_EOL;
            return false;
        }

        if(!file_exists($this->basePath . '/images/' . $modelDirName)) {
            mkdir($this->basePath . '/images/' . $modelDirName);
            echo ' common images will be saved here: ' . $modelDirName;
            $this->alarm();
        } else {
            echo 'images were already saved for: ' . $itemUrl;
            return false;
        }

        if(!file_exists($this->basePath . '/images360/' . $modelDirName)) {
            mkdir($this->basePath . '/images360/' . $modelDirName);
        }
        
        $htmlcontent = file_get_contents($itemUrl);
        $this->document = phpQuery::newDocument($htmlcontent);
        $this->parseTextData($itemUrl);
        
        $links = $this->document->find('a.thumb');
        $images360Parsed = false;

        foreach($links as $i => $link) {
            $name = $i + 1;
            echo $link->getAttribute('href') . PHP_EOL;

            $image = file_get_contents($link->getAttribute('href'));
            file_put_contents($this->basePath . '/images/'. $modelDirName . '/' . $name . '.jpg', $image);

            if($link->getAttribute('dzi') && !$images360Parsed) {
                $images360Parsed = true; 
                $this->saveAll360Images($link->getAttribute('dzi'), $modelDirName);
            }
        }
    }
    
    private function alarm()
    {
        echo 'ALARM mock' . PHP_EOL;
    }
    
    private function parseTextData($itemUrl)
    {
        $fp = fopen($this->basePath . '/models.txt', 'a+');

        //$htmlcontent = file_get_contents($itemUrl);
        //$this->document = phpQuery::newDocument($htmlcontent);

        $header = $this->document->find('h1');

        $modelName = '';
        if(!empty($header[0])) {
            $modelName = $header[0]->text();
        } else {
            echo "no model name for: " . $itemUrl . PHP_EOL;
            return false;
        }
        $modelName = str_replace('3D model of ', '', $modelName);        

        $description = $this->document->find('div.description');
        $keywords = '';

        if(!empty($description)) {
            $keywords = $description->text();
        } else {
            echo "no keywords for: " . $itemUrl . PHP_EOL;
            return false;
        }

        $keywords = trim(str_replace('Search by keywords:', '', $keywords));
        
        $spanPrice = $this->document->find('span.price-single');
        $price = str_replace('$', '', $spanPrice->text());

        fputcsv($fp, [$itemUrl, $modelName, $price, $keywords]);
    }

    private function saveAll360Images($firstImageLink, $modelSubdir)
    {
        for($i = 1; $i <= 50; ++$i) {
            $imageUrl = preg_replace('/\d.jpg/i', $i . '.jpg', $firstImageLink);
            $image = file_get_contents($imageUrl);

            file_put_contents($this->basePath . '/images360/'. $modelSubdir . '/' . $i . '.jpg', $image);
        }
    }
}   

$itemParser = new ItemParser(['BASE_PATH' => '/home/dmitri/3dhumster']); 
$itemParser->parseItemInformation($argv[1]);