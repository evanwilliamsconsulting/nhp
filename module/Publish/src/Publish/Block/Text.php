<?php

class NHP_Helper_Text extends Zend_View_Helper_Abstract
{
	public $view;

	public function rich($rich,$elements)
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("Rich Helper");
		$details=print_r($rich,true);
		$logger->info($rich);
		$logger->info($elements);
		$style='border-style:none;border-color:pink;border-width:1px;background-color:white;color:black;font-size:normal;';
		$style.='width:';
		$style.='400';
		$style.='px;';
		$style.='text-align:justify;';
		$this->view->style=$style;
		$outputText = "";
		foreach ($rich as $key => $line)
		{
//			$line2 = preg_replace("/\&([a-z]+);/",'&$1;',$line);
			$line2 = htmlentities($line);
			$outputText .= $line2;
			
/* See more at: http://af-design.com/blog/2010/08/17/escaping-unicode-characters-to-html-entities-in-php/#sthash.6Lq0En6i.dpuf
*/
			$outputText .= " ";
		}
		$this->view->lines=$outputText;
		return $this->view->partial('partial/text.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
