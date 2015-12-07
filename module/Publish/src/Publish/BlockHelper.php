<?php
namespace Publish;

use Zend\View\Helper\AbstractHelper;
use Zend\Http\Client;
use Zend\Http\Request;

use Publish\Fetcher;

class BlockHelper extends AbstractHelper
{
	protected static $state;
	protected $pixObject;
	protected $username;
	protected $itemId;
	protected $snapshot;
	public $view;
	public $output;
	public $results_top;
	public $containers;
	public $results_left;
	public $emptyArray;
	public $broadsheet;
	public $name;
	public $position;
	public $uri;
	public $fetcher;
	
	public function setBaseURI($uri)
	{
		$this->fetcher = Fetcher::retrieveFetcher();
		$this->fetcher->setBaseURI($uri);		
		$this->uri = $uri;
	}
	public function getBaseURI()
	{
		return $this->uri;
	}
	public function setFrag($frag)
	{
		   $this->fetcher = Fetcher::retrieveFetcher();
	    $this->fetcher->addFrag($frag);
	}
	public function fetch()
	{
		     $this->fetcher = Fetcher::retrieveFetcher();
		     $this->fetcher->fetch();		
        $this->snapshot = $this->fetcher->getSnapshot();
		
		//$this->fetcher = Fetcher::retrieveFetcher();
	/*
		$uri = $this->getBaseURI();
		
		$request = new Request();
		$request->setUri($uri);
		
		$client = new Client();
		
		$client->setMethod(REQUEST::METHOD_GET);
		$client->setOptions(array('timeout'=>120));
		
		$response = $client->send($request);

		$this->snapshot = $response->getBody();
		
		return TRUE;
	*/
	}
	public function getSnapshot()
	{
		return $this->snapshot;
	}
}

?>
