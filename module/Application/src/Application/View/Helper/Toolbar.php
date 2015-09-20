<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class Toolbar extends AbstractHelper
{
    public function __invoke()
    {
	$retval = "<ul>";
	$retval .= "<li><a href='http://newhollandpress.com/wordage/new'>Add Wordage</a></li>";
	$retval .= "<li><a href='http://newhollandpress.com/article/new'>Add Free-form Article</a></li>";
	$retval .= "<li><a href='http://newhollandpress.com/pix/new'>Add Pix</a></li>";
	$retval .= "<li><a href='http://newhollandpress.com/container/new'>Add Container</a></li>";
	$retval .= "</ul>";
        return $retval;
    }
}
?>
