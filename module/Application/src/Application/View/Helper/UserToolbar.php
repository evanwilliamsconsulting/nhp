<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
 
class UserToolbar extends AbstractHelper
{
    protected static $state;
    protected $loggedin = false;
    protected $username = "";

    public function __invoke()
    {
	$userToolbarHTML = "<ul>";
    	// This top id is rendered separately
    	// we can rename it and keep it going!
    	//$siteToolbarHTML = "<div id='site_toolbar' class='toolbar'>";
        	if (!($this->loggedin))
        	{
			$userToolbarHTML .= '<li class="usertab bright"><a href="#" onclick="';
			$userToolbarHTML .= 'clickLogin();">';
			$userToolbarHTML .= "Login";
			$userToolbarHTML .= "</a></li>";
		}
		else 
		{
	        	$userToolbarHTML = "<li class='usertab bright'>Welcome&nbsp;" . $this->username . "</li>";
			$userToolbarHTML .= '<li class="usertab bright"><a href="/auth/logout">';
			//$userToolbarHTML .= 'clickLogout();">';
			$userToolbarHTML .= "Logout";
			$userToolbarHTML .= "</a></li>";
        	}
		$userToolbarHTML .= "</ul>";
		return $userToolbarHTML;
    }
    public function setState()
    {
        $this->state = true;
    }
    public function clearState()
    {
        $this->state = false;
    } 
    public function setLoggedIn($loggedin)
    {
	$this->loggedin=$loggedin;
    }
    public function setUserName($username)
    {
	$this->username=$username;
    }
}
?>
