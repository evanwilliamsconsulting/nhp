<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\ServiceManager\ServiceLocatorAwareInterface;  
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ViewModel;
use Application\Service\WordageService as WordageService;  
 
class WordageHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected static $state;
	protected $wordageObject;
	protected $username;
	protected $itemId;
	protected $viewmodel;
	protected $renderer;
	protected $wordageService;

    /** 
     * Set the service locator. 
     * 
     * @ param ServiceLocatorInterface $serviceLocator 
     * @ return CustomHelper 
     */ 
    public function __construct(WordageService $wordageService)
	{
		$this->wordageService = $wordageService;
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
	public function setWordageObject($wordageObject)
	{
		$this->wordageObject = $wordageObject;
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
    public function __invoke()
    {
    	//$sm = $this->getServiceLocator()->getServiceLocator();  
        //$config = $sm->get('application')->getConfig(); 
 
        $retval = "<div>";
		$retval .= "Wordage Helper";
		$retval .= print_r($this->wordageService->findAllWordage(),true);
		$retval .= "</div>";
    	
    	//$view = $this->getViewModel();
		
		//$view->setTemplate('items/wordage.phtml');
		
		//return $view;
		
		return $retval;
		
		//return print_r($view,true);
    }
}
?>