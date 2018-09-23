<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
 
class SiteToolbar extends AbstractHelper
{
    protected static $state;

    public function __invoke()
    {
    	// This top id is rendered separately
    	// we can rename it and keep it going!
    	//$siteToolbarHTML = "<div id='site_toolbar' class='toolbar'>";
		$siteToolbarHTML = "<ul class='sitelist'>";
		$siteToolbarHTML .= "<li class='sitetab'>Home</li>";
		$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>";
		$userSession = new Container('user');
        	if (!isset($userSession->loggedin))
        	{
			$userToolbarHTML .= '<li onclick=\"';
			$userToolbarHTML .= "clickLogin();";
			$userToolbarHTML .= "\">";
			$userToolbarHTML .= "Login";
			$userToolbarHTML .= "</li>";
		}
		else 
		{
	        	$username = $userSession->username;
	        	$userToolbarHTML = "Welcome&nbsp;" . $username;
			$userToolbarHTML .= "<li onclick=\"";
			$userToolbarHTML .= "clickLogout();";
			$userToolbarHTML .= "\">";
			$userToolbarHTML .= "Logout";
			$userToolbarHTML .= "</li>";
        	}
		$siteToolbarHTML .= $userToolbarHTML;
		$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>";
		$siteToolbarHTML .= "<li class='sitetab'>Issues</li>";
		$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>";
		$siteToolbarHTML .= "<li class='sitetab'>Write!</li>";
		$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>";
		$siteToolbarHTML .= "<li class='sitetab'>Advertise!</li>";
		$siteToolbarHTML .= "<li class='sitetab'>&nbsp;&nbsp;</li>";
		$siteToolbarHTML .= "<li class='sitetab'>Contact</li>";
		$siteToolbarHTML .= "</ul>";
		$siteToolbarHTML .= "</div>";
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
}
?>
