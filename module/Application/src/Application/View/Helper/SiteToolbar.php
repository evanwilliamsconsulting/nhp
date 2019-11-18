<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
 
class SiteToolbar extends AbstractHelper
{
    protected static $state;
    protected $loggedIn;
    protected $username;

    public function __invoke()
    {
    	// This top id is rendered separately
    	// we can rename it and keep it going!
    	//$siteToolbarHTML = "<div id='site_toolbar' class='toolbar'>";
		//$siteToolbarHTML = "<ul class='sitelist'>";
		$siteToolbarHTML = "";
		$siteToolbarHTML .= "<li class='sitetab bright'>Home</li>\n";
		//$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'>Issues</li>\n";
		//$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'>Write!</li>\n";
		//$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'>Advertise!</li>\n";
		//j$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'>Contact</li>\n";
		//$siteToolbarHTML .= "</ul>";
		return $siteToolbarHTML;
    }
    public function setState()
    {
        $this->state = true;
    }
    public function clearState()
    {
        $this->state = false;
    } 
    public function setLoggedIn($loggedIn)
    {
	$this->loggedIn = $loggedIn;
    }
    public function setUserName($username)
    {
	$this->username=$username;
    }
}
?>
