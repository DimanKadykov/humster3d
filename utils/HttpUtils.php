<?php

/**
 * Description of HttpUtils
 *
 * @author dmitri
 */
class HttpUtils
{
   static function retrieveFlashMessages()
   {
       if(empty($_SESSION['flash'])) {
           return [];
       }
       
       $flashes = explode('&', $_SESSION['flash']);
       $decodedFlashes = [];
       foreach($flashes as $flash) {
           $decodedFlashes[]= urldecode($flash);
       }
       
       $_SESSION['flash'] = '';
       
       return $decodedFlashes;
   }
   
   static function addFlash($message)
   {
       $currentFlashes = self::retrieveFlashMessages();
       $currentFlashes[]= urlencode($message);
              
       $_SESSION['flash'] = join('&', $currentFlashes);
   }
}
