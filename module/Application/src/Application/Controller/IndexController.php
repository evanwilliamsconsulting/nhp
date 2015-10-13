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

class IndexController extends AbstractActionController
{
	private $windowWidth;
	private $windowHeight;
	
    public function indexAction()
    {
    	$this->getServiceLocator()->get('log')->info('Will work equally well');
	    $view = new ViewModel();
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
	public function setsizeAction()
	{
		/*
		 * This is correct code for receiving parameters from an ajax call
		 * But not the way to go about setting the window sizes.
		 * Need to use window.resize and percentages in layout.
		 */
		$view = new ViewModel();
		$view->setTerminal(true);
		$result = $_POST;
		$this->windowWidth = $result['width'];
		$this->windowHeight = $result['height'];
		$view->data = "success";
		return $view;
	}
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
