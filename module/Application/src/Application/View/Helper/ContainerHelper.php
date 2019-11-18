<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
//use Application\Service\ContainerService as ContainerService;  
 
class ContainerHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
	protected $containerObject;
	protected $container;
	protected $username;
	protected $itemId;
	protected $viewmodel;
	protected $renderer;
	protected $em;

    /** 
     * Set the service locator. 
     * 
     * @ param ServiceLocatorInterface $serviceLocator 
     * @ return CustomHelper 
     */ 
    public function __construct()
	{
	}
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)  
    {  
        $this->serviceLocator = $serviceLocator;  
        return $this;  
    } 
    /** 
     * Get the service locator. 
     * 
     * @ return \Zend\ServiceManager\ServiceLocatorInterface 
     */  
    public function getServiceLocator()  
    {  
        return $this->serviceLocator;  
    }  
    public function setViewModel(ViewModel $viewmodel)
	{
		$this->viewmodel = $viewmodel;
	}
	public function getViewModel()
	{
		return $this->viewmodel;
	}
	public function setContainerObject($containerObject)
	{
		$this->containerObject = $containerObject;
	}
	public function getContainerObject()
	{
		return $this->containerObject;
	}
	public function toHTML()
	{
		$html = " Items: ";
		$containerObject = $this->containerObject;
		$containerObject->setEntityManager($this->em);
		$items = $containerObject->getItems();
		$html .= "</br>";
		foreach ($items as $key1 => $item2)
		{
			//$html .= "</br>";
			// $html .= $key1;
			$obj2 = $item2["object"];
			$itemid = $obj2->getItemId();
			$itemtype = $obj2->getItemType();
			if ($itemtype == "WORD")
			{
				$html .= "<br/>";
				// $html .= "Wordage";
				// $html .= "<br/>";
				// $html .= "Wordage Id: ";
				// $html .= $itemid;
				$em = $this->getEntityManager()	;
		
				$wordage = $em->getRepository('Application\Entity\Wordage')->find($itemid);
		
				$theWords = $wordage->getWordage();
				$title = $wordage->getTitle();

				$html .= "<br/>";
				$html .= "Title: ";
				$html .= $title;
				$html .= "<br/>";
				$html .= $theWords;
		
			}
			$html .= "</br>";
			$html .= print_r($obj2,true);
			$html .= "</br>";
			$html .= "</br>";
			$html .= print_r($item2,true);
			$html .= "</br>";
		}
		$html .= "</br>";
		return $html;
	}
	public function setUsername($username)
	{
		$this->username = $username;
	}
	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
	}
	public function setRenderer($renderer)
	{
		$this->renderer = $renderer;
	}
	public function getRenderer()
	{
		return $this->renderer;
	}
    public function setEntityManager($em)
    {
    	$this->em = $em;
    }
	public function getEntityManager()
	{
		return $this->em;
	}
    public function __invoke()
    {
        $viewRender = $this->getServiceLocator()->get('ViewRenderer');
    	//$sm = $this->getServiceLocator()->getServiceLocator();  
        //$config = $sm->get('application')->getConfig(); 
 
        //$retval = "<div>";
	//	$retval .= $this->containerObject->getWordage();
	//	$retval .= "</div>";
    	
    	$view = $this->getViewModel();

    	//$view->html = $this->toHTML();
		
	$view->setTemplate('items/container.phtml');
		

	//return print_r($this->containerObject,true);
	//return $view;
	return $this->toHTML();
		
		//return $retval;
		
//		return print_r($view,true);
//	return $viewRender->render($view);
    }
}
