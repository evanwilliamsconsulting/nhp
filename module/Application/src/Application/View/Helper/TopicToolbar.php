<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class TopicToolbar extends AbstractHelper
{
	protected $topicType;
	protected $base;
	 

    public function __invoke($topic,$id)
    {
	#2do Move embedded links
    	$this->base = "https://www.evtechnote.us/";
		$this->base .= $topic;	
		$retval = "<ul class='toolbar-list'>";
		$retval .= "<li id='topic-toolbar-view' class='toolbar-tab'><a href='https://www.evtechnote.us/wordage/view/" . $id . "' );'>View</a></li>";
		$retval .= "<li class='toolbar-tab'>&nbsp;&nbsp;</li>";
		$retval .= "<li id='topic-toolbar-edit' class='toolbar-tab'><a href='#' onclick='loadEditForm(" . $id . ");'>Edit</a></li>";
		$retval .= "<li class='toolbar-tab'>&nbsp;&nbsp;</li>";
		$retval .= "<li id='topic-toolbar-save' class='toolbar-tab'><a href='#' onclick='saveEditForm(" . $id . ");'>Save</a></li>";
		$retval .= "</ul>";
        
        return $retval;
    }
}
?>
