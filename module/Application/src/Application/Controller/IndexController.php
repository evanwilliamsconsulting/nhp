<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Hex\View\Helper\CustomHelper;
use Application\Form\Panel\LoginForm;
use Zend\EventManager\EventManger;
use Publish\BlockHelper as BlockHelper;
use Publish\Block\Broadsheet;

class IndexController extends AbstractActionController
{
	private $windowWidth;
	private $windowHeight;
    protected $storage;
    protected $authservice;
    protected $log;
 
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
        return $this->authservice;
    }
    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                                  ->get('Application\Storage\Login');
        }
        return $this->storage;
    }
    public function indexAction()
    {
    	$log = $this->getServiceLocator()->get('log');
    	$log->info('Will work equally well');
	    $view = new ViewModel();


	if ($this->getAuthService()->getIdentity() != NULL)
	{
	  	    $log->info("Set Logged In and Username attributes in Helpers");
		    $layout = $this->layout();
		    foreach($layout->getVariables() as $child)
		    {
			$log->info(print_r($child,true));
			$child->setLoggedIn(true);
			$child->setUserName($username);
		    }
	}
	
	    
	    $log->info("Got View Model");
	    $view->content = $this->content();
	
/*
				$year = '2015';
				$month = '12';
				$day = '15';
				$pageno = 1;
				$broadsheet = new Broadsheet($year,$month,$day,$pageno);
*/
	    //$broadsheet = new Broadsheet("http://nhpress.net/index_html/pageone/");
/*
	    $broadsheet->refresh();
	    $log->info("New Block Helper");
	    $log->info("set Base URI");
	    $snapshot = $broadsheet->toHTML();
	    $log->info("snapshot");
*/

	    $log->info("content");
	    
		/*
		 * On window resize you are to call the resize event.
		 * Do not PUSH window size out!
		 *
		$view->width = $this->windowWidth;
		$view->height = $this->windowHeight;
		$view->style = "background-color:red;width:";
		$view->style .= $this->width;
		$view->style .= "px;height:100px;";
		 * 
		 */
    	$logger = $this->getServiceLocator()->get('log');
	$view->message = "OK";
    	$this->getServiceLocator()->get('log')->info("Hi");
        return $view;
    }
	public function loginAction()
	{
		$view = new ViewModel();
		$view->setTerminal(true);
		$form = new LoginForm();
		$boxHTML = "<div>TEST</div>";
		$view->box = $form;
		return $view;
	}
/*
	public function setsizeAction()
	{
		/
		 * This is correct code for receiving parameters from an ajax call
		 * But not the way to go about setting the window sizes.
		 * Need to use window.resize and percentages in layout.
		 *
		$view = new ViewModel();
		$view->setTerminal(true);
		$result = $_POST;
		$this->windowWidth = $result['width'];
		$this->windowHeight = $result['height'];
		$view->data = "success";
		return $view;
	}
*/
    public function welcomeAction()
    {
        $view = new ViewModel();

        $view->content = $this->content();
        
        return $view;
    }
    public function content()
    {
	return "content";
    }
}
