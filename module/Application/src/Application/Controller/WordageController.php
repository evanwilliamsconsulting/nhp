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
use Zend\View\Model\JsonModel;
use Application\Entity\Wordage;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\WordageForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class WordageController extends AbstractActionController
{
    protected $em;
	protected $authservice;
	protected $username;
	protected $log;
 
    public function __construct()
	{
	}
    public function getEntityManager()
    {
        if (null == $this->em)
        {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	}
	return $this->em;
    }
	public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
        return $this->authservice;
    }
    public function indexAction()
    {
    	$view = new ViewModel();
	    $view->content = $this->content();
		
		$layout = $this->layout();
		// This second layout look really should happen if logged in.
		$layout->setTemplate('layout/correspondant');
		
        return $view;
    }
    public function viewAction()
    {
    	// Load the logger
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	$log->info("view action");
		
		// Initialize the View
    	$view = new ViewModel();
		// Retreive the parameters
		$id = $this->params()->fromRoute('item');
	    $log->info($id);
		
		// 2Do: Check to see that user is logged in
/*
 	$persistent = $this->getAuthService()->getStorage();
	$username = $persistent->getUsername();
	$log->info($username);
*/
/*
    	if (!$this->getAuthService()->hasIdentity())
        {
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
        }
*/
    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$log->info($this->username);
		
		$em = $this->getEntityManager();
		
		$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
		
		//$topic = new \Application\View\Helper\TopicToolbar('wordage');
		//$view->topic = $topic();
		$theWords = $wordage->getWordage();
		$title = $wordage->getTitle();
		
		$view->title = $title;
		$view->content = $theWords;
		$view->id =$id;
        return $view;
    }
    public function content()
    {
	return "content";
    }
    public function wordageAction()
    {
	$view = new ViewModel();
        $view->content = $this->content();
        return $view;
    }
    public function newAction()
    {
	$view = new ViewModel();
        return $view;
    }
    public function changeAction()
    {
	$changedtext = $this->params()->fromPost('thetext');

	$wordageid = $this->params()->fromPost('id');
	$theId = substr($wordageid,strpos('wordage-',$wordageid)+8,strlen($wordageid));
	$theArray = array('id' => $theId);

	$em = $this->getEntityManager();
	$wordage = $em->getRepository('Application\Entity\Wordage')->findOneBy($theArray);

	$wordage->setWordage($changedtext);
	$em->persist($wordage);
	$em->flush();

	$variables = array("status" => "200",'id'=>$theId,'wordage'=>print_r($wordage,true));
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function editAction()
    {
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
	$log->info("Wordage Edit");
	$view = new ViewModel();
	$renderer = new PhpRenderer();
	$resolver = new Resolver\AggregateResolver();
	$renderer->setResolver($resolver);
	$log->info("Wordage Edit: setResolver");

	$map = new Resolver\TemplateMapResolver(array(
    		'edit'      => __DIR__ . '/../../../view/application/wordage/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);
	$log->info("Wordage Edit: setResolver");
	$log->info("Wordage Edit: retrieveWordage");

	$wordageid = $this->params()->fromRoute('item');
	$log->info($wordageid);
	//$wordageid = $this->params()->fromQuery('id');
	$log->info("Wordage Edit: fromQuery");
	// Looking for: wordage- or 8 chars
	$log->info("Wordage Edit: setid ". $wordageid);

	$theArray = array('id' => $wordageid);

	$em = $this->getEntityManager();
	$log->info("Wordage Edit: findOne");
	$log->info(print_r($theArray,true));
	$wordage = $em->getRepository('Application\Entity\Wordage')->findOneBy($theArray);
	$log->info("Wordage Edit: findOne");
	$actualWords = $wordage->getWordage();
	$theWords = $wordage->getWordage();
	$title = $wordage->getTitle();
		
	$view->title = $title;
	$view->content = $theWords;
	$view->id =$id;
	return $view;
    }
    public function editinplaceAction()
    {
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
	$log->info("Wordage Edit");
	$viewModel = new ViewModel();
	$viewModel->setTemplate("edit");
	$renderer = new PhpRenderer();
	$resolver = new Resolver\AggregateResolver();
	$renderer->setResolver($resolver);
	$log->info("Wordage Edit: setResolver");

	$map = new Resolver\TemplateMapResolver(array(
    		'edit'      => __DIR__ . '/../../../view/application/wordage/edit.phtml',
	));
	$stack = new Resolver\TemplatePathStack(array(
    		'script_paths' => array(
        	__DIR__ . '/view',
    		)
	));

	$resolver->attach($map);
	$resolver->attach($stack);
	$log->info("Wordage Edit: setResolver");
	$log->info("Wordage Edit: retrieveWordage");

	$wordageid = $this->params()->fromRoute('item');
	$log->info($wordageid);
	//$wordageid = $this->params()->fromQuery('id');
	$log->info("Wordage Edit: fromQuery");
	// Looking for: wordage- or 8 chars
	$viewModel->setVariable('theid',$wordageid);
	$log->info("Wordage Edit: setid ". $wordageid);

	$theArray = array('id' => $wordageid);

	$em = $this->getEntityManager();
	$log->info("Wordage Edit: findOne");
	$log->info(print_r($theArray,true));
	$wordage = $em->getRepository('Application\Entity\Wordage')->findOneBy($theArray);
	$log->info("Wordage Edit: findOne");
	$actualWords = $wordage->getWordage();
	$viewModel->setVariable('actualWords',$actualWords);
	$viewModel->setVariable('id',$theId);
	$log->info("Wordage Edit: fix JSON");

	$variables = array("id" => $wordageid,"view" => $renderer->render($viewModel),"thewordage" => print_r($wordage,true));
	$log->info("Wordage Edit: variables");
	$log->info(print_r($variables,true));
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	$log->info("Wordage Edit: return JSON");
	return $response;
    }
}
