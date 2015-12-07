<?php

namespace Publish;

use Zend\Http\Client;
use Zend\Http\Request;
/*
 https://sourcemaking.com/design_patterns/singleton/php/1
*/
class Fetcher
{
    protected static $fetcher;
    protected static $initialized;
    protected static $baseURI;
    protected static $frag;

    private function __construct()
   {
	      self::$frag ="";
   } 
    static function retrieveFetcher() 
    { 
        if (FALSE == self::$initialized)
        { 
            if (NULL == self::$fetcher)
            { 
                self::$fetcher = new Fetcher(); 
            } 
            self::$initialized = TRUE; 
            return self::$fetcher; 
        } 
        else 
        { 
            return self::$fetcher;
        } 
    }
   public function getSnapshot()
   {
	      return $this->snapshot;
   }
    public function fetch()
    {
        $base = $this->getBaseURI();
        $frag = $this->getFrag();

        $uri = $base . $frag . '/json';
		
        $request = new Request();
        $request->setUri($uri);
		
        $client = new Client();
		
        $client->setMethod(REQUEST::METHOD_GET);
        $client->setOptions(array('timeout'=>120));
		
        $response = $client->send($request);

        $this->snapshot = $response->getBody();
		
        return TRUE;
    }
    public function setBaseURI($uri)
    {
      	self::$baseURI = $uri;
    }
    public function getBaseURI()
    {
        return self::$baseURI;
    }
    public function addFrag($frag)
    {
	        self::$frag = $frag;
    }
    public function getFrag()
    {
	        return self::$frag;
    }
}
