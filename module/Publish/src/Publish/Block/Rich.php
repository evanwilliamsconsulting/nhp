<?php

class NHP_Helper_Rich extends Zend_View_Helper_Abstract
{
	public $view;

	public function rich($rich,$elements)
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("Rich Helper");
		$details=print_r($rich,true);
		$logger->info($rich);
		$logger->info($elements);
		$style='margin:10px;padding:10px;border-style:none;border-color:pink;border-width:1px;background-color:white;color:black;font-size:normal;';
		$style.='width:';
		$style.=$elements['width'];
		$style.='px;';
		$style.='text-align:justify;';
		$this->view->style=$style;
		$outputText = "";
		foreach ($rich as $key => $line)
		{
			$logger->info($line);
			$line2 = preg_replace("/\&([a-z]+);/",'&$1;',$line);
			//$line2 = htmlentities($line2);
			$logger->info($line2);
			$line3 = preg_replace("/BREAK/",'<br/><br/>',$line2);
			$logger->info($line3);
			$outputText .= $line3
			;
			
/* See more at: http://af-design.com/blog/2010/08/17/escaping-unicode-characters-to-html-entities-in-php/#sthash.6Lq0En6i.dpuf
*/
			$outputText .= " ";
		}
		$this->view->lines=$outputText;
		return $this->view->partial('partial/rich.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
