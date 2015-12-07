<?php

class NHP_Helper_Pix extends Zend_View_Helper_Abstract
{
	public $view;

	public function pix($pix,$caption,$width,$height)
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("Pix Helper");
		$details=print_r($pix,true);
		$logger->info($details);
		$style='';
		$this->view->pix=$pix;
		$this->view->caption=$caption;
		if (0==strcmp('Is this Red Currant or Gooseberry?',$caption))
		{
			$style .= "top:200px;";
		}
		$this->view->style=$style;
		$this->view->width=$width;
		$this->view->height=$height;
		return $this->view->partial('partial/pix.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
