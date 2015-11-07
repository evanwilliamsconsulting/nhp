<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class Toolbar extends AbstractHelper
{
    public function __invoke()
    {
    	//$retval = "<div id='item_tabs'>";
		$retval = "<ul class='itemlist'>";
		$retval .= "<li class='itemtab'><a href='http://newhollandpress.com/wordage/new'>Wordage</a></li>";
		$retval .= "<li class='itemtab'><a href='http://newhollandpress.com/article/new'>Free-form Article</a></li>";
		$retval .= "<li class='itemtab'><a href='http://newhollandpress.com/pix/new'>Pix</a></li>";
		$retval .= "<li class='itemtab'><a href='http://newhollandpress.com/container/new'>Container</a></li>";
		$retval .= "</ul>";
		//$retval = "</div>";
        return $retval;
    }
}
?>
