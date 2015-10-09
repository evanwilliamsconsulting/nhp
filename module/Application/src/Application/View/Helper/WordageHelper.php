<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
 
class WordageHelper extends AbstractHelper
{
    protected static $state;
	protected $wordageObject;
	protected $username;
	protected $itemId;

	public function setWordageObject($wordageObject)
	{
		$this->wordageObject = $wordageObject;
	}
	public function setUsername($username)
	{
		$this->username = $username;
	}
	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
	}
    public function __invoke()
    {
    	$wordageObject = $this->wordageObject;
		$base = 'https://newhollandpress.com/wordage/view/';
		$title = $wordageObject->getTitle();
		$id = $wordageObject->getId();
		$output = "<div id='" . $this->itemId . "' class='itemHelper_Wide'>";
		$output .= "<ul>";
		$output .= "<li>";
		$output .= "<span>Wordage</span>";
		$output .= "</li>";
		$output .= "<li>";
		$output .= "<a href='" . $base . "'>" . $title . "</a>";
		$output .= "</li>";
		$output .= "<li>";
		$output .= $wordageObject->getWordage();
		$output .= "</li>";
		$output .= "</ul>";
		$output .= "</div>";
		
		return $output;
    }
}
?>
