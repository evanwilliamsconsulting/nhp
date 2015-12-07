<?php

class NHP_Helper_Headline extends Zend_View_Helper_Abstract
{
	public $view;
	public $content;

	public function headline($headline,$width)
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("Headline Helper");
		$details=print_r($headline,true);
		$logger->info($details);
		$this->view->style='width:400px;background-color:white;color:black;font-size:x-large';
		//$line2 = preg_replace("/\&([a-z]+);/",'&$1;',$headline);
		$logger->info($headline);
		$this->view->headline=$headline;
		$this->content=$this->view->partial('partial/headline.xhtml');
	}
	public function getContent()
	{
		return $this->content;
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
