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

use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\View\Helper\ContainerHelper as ContainerHelper;

class IndexController extends AbstractActionController
{
    protected $em;
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
	$this->log = $this->getServiceLocator()->get('log');
	$view = new ViewModel();

	$this->log->info("test");

	if ($this->getAuthService()->getIdentity() != NULL)
	{
		    $layout = $this->layout();
		    foreach($layout->getVariables() as $child)
		    {
			$child->setLoggedIn(true);
			$child->setUserName($username);
		    }
	}
	
	    
	    $view->content = $this->content();
	
	    
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
	$view->message = "OK";

        $em = $this->getEntityManager();

	$items = new Containers();
	$items->setEntityManager($em);
	$items->loadDataSource();


	$theItems = $items->toArray();
	$html = "Page One";
	$html .= "<br/>";
	$html .= "<br/>";
	foreach ($theItems as $key => $item)
	{
		$containerItem = new ContainerHelper();
		$containerItem->setServiceLocator($this->getServiceLocator());
		$containerItem->setViewModel($view);
		$containerItem->setEntityManager($em);
		$containerItem->setContainerObject($item["object"]);
		$html .= $containerItem->toHTML();
		$html .= "<br/>";
		$html .= "<br/>";
	}
	$view->content = $html;
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
    public function getEntityManager()
    {
        if (null == $this->em)
        {
	    try {
            	$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                //$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            } catch (Exception $e) {
		//print_r($e);
		//print_r($e-getPrevious());
	    }
	}
	return $this->em;
    }
}
