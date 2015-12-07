<?php
namespace Publish\Block;

use Zend\View\Helper\AbstractHelper;
use Publish\BlockHelper as BlockHelper;

class Container extends BlockHelper
{
	public $view;
	public $output;
	public $results_top;
	public $results_left;
	public $emptyArray;
	public $broadsheet;
	public $name;
	public $position;
	public $items;
	public $container;
	public $frag;
	
	public function __construct()
	{
	    //$this->frag = $frag;
	    //parent::setFrag($frag);
	}
	public function setName($name)
	{
	    parent::setFrag($name);
	}
	public function getTop()
	{
		return $this->top;
	}
	public function getLeft()
	{
		return $this->left;
	}
	public function getHeight()
	{
		return $this->height;
	}
	public function getWidth()
	{
		return $this->width;
	}
	public function fetch()
	{
		parent::fetch();
		$container = json_decode(parent::getSnapshot());
		$this->container = $container->containers;
	}
	public function toHTML()
	{
		$this->fetch();
		
		$returnHTML = "<div>";
		$items = $this->container;
		$returnHTML .= print_r($items,true);
		$returnHTML .= "</div>";
		return $returnHTML;
		foreach ($items as  $key =>$item)
		{
			$returnHTML .= "<div>";			
		    //$attributes = $item->attributes;
		    $elements = $item->elements;
		    $type = $item->type;
		    $snapshot = "type:";
		    $snapshot .= print_r($type,true);
		    $snapshot .= "<br/>";
		    $snapshot .= "elements";
		    /*
		     * 
		     * 
		     *  [glueX] =>
		     *  [prevX] =>
		     *  [offsetY] => 0
		     *  [offsetX] => 0
		     *  [glueY] =>
		     *  [prevY] =>
		     *  [gravity] => 1
		     *  [drift] => 1
		     *  [resetX] =>
		     *  [height] => 250
		     *  [resetY] =>
		     *  [width] => 165
		     */
		    $glueX = $elements->glueX;
		    $prevX = $elements->prevX;
		    $offsetY = $elements->offsetY;
		    $offsetX = $elements->offsetX;
		    $glueY = $elements->glueY;
		    $prevY = $elmenets->prevY;
		    $gravity = $elements->gravity;
		    $drift = $elements->drift;
		    $resetX = $elements->resetX;
		    $height = $elements->height;
		    $resetY = $elements->resetY;
		    $width = $elements->width;
		    
		    $elementsHTML = "<div style='background-color:white;width:";
		    $elementsHTML .= $width;
		    $elementsHTML .= "px;height:";
		    $elementsHTML .= $height;
		    $elementsHTML .= "px'>";
		    if ( $type == "Pix" )
		    {
		    	$attributes = $item->attributes;
		    	$pixpath = $attributes->pixpath;
		    	$width = $attributes->width;
		    	$height = $attributes->height;
		    	$pixHTML = "<img src='";
		    	$pixHTML .= $pixpath;
		    	$pixHTML .= "' width=";
		    	$pixHTML .= $width;
		    	$pixHTML .= "px height=";
		    	$pixHTML .= $height;
		    	$pixHTML .= "px/>";
		    	$elementsHTML .= $pixHTML;
		    }
		    
		    $diagnosticHTML .= "<span>width:";
		    $diagnosticHTML .= $width;
		    $diagnosticHTML .= "</span><span>height:";
		    $diagnosticHTML .= $height;
		    $diagnosticHTML .= "</span>";
		    $spanHTML = "</div>";
		    
		    $snapshot .= $elementsHTML;
		    //$snapshot .= "<br/>";
		    //$snapshot .= "attributes";
		    //$snapshot .= print_r($attributes,true);
		    //$returnHTML .= $snapshot;
		    
		    if ( $type == "RichColumn")
			{
				$richHTML = "<div>";
				$lines = $item->lines;
				foreach ($lines as $key => $line)
				{
					$richHTML .= "<div>";
					$richHTML .= $line;
					$richHTML .= "</div>";
				/*     $totalLines = $item->totalLines;
				     $lines = $item->lines;
				     $numberOfLines = count($lines);
				     $snapshot .= "<h1>Number of Lines</h1>";
				     $snapshot .= $totalLines;
				     $snapshot .= "<br/>";
				     $snapshot .= "lines";
				     $snapshot .= print_r($lines,true);
				     */
				}
				$richHTML .= "</div>";
				$snapshot .= $richHTML;
		    }
		    $returnHTML .= $snapshot;
		    $returnHTML .= "</div>";
		}
		$returnHTML .= "</div>";
		return $returnHTML;
	}
	
}

?>
