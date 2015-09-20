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
use Application\Entity\Wordage;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\WordageForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;

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
    	if (!$this->getAuthService()->hasIdentity())
        {
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/');
        }
    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$log->info($this->username);
		
		$em = $this->getEntityManager();
		
		$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);
		
		//$topic = new \Application\View\Helper\TopicToolbar('wordage');
		//$view->topic = $topic();
		$theWords = $wordage->getWordage();
		
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
	public function editAction()
	{
		$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	$log->info("new form");

	    $view = new ViewModel();
        $form = new WordageForm();
    	// 2015-09-10
    	// 2Do: Check to see that user is logged in
    	if (!$this->getAuthService()->hasIdentity())
        {
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/wordage/index');
        }
    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$log->info($this->username);
    	// 2Do: Implement Calendar Widget in Javascript for date and fix validation
        $form->get('submit')->setValue('Edit');

		// Retreive the parameters
		$id = $this->params()->fromRoute('item');
	    $log->info($id);
		
		$em = $this->getEntityManager();
		
		$wordage = $em->getRepository('Application\Entity\Wordage')->find($id);

        $form->bind($wordage);
        //$form->get('username')->setValue($this->username);
        $request = $this->getRequest();
		//$log->info($request);
        if ($request->isPost()) {
            $em = $this->getEntityManager();

            $inputFilter = $wordage->getInputFilter();
    
	    $form->setInputFilter($inputFilter);
	    $form->setData($request->getPost());
		$log->info(print_r($request->getPost(),true));
		//$theData = $form->getData();
		//$log->info(print_r($theData,true));
	    if ($form->isValid())
	    {
	       $log->info("is valid!");
		   $wordage->exchangeArray($request->getPost());
		   $log->info("data exchanged");
		   $log->info(print_r($form->getData(),true));
	       $em->persist($form->getData());
		   $log->info("persisted");
	       $em->flush();
		   $log->info("flushed");
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/wordage/index');
	    }

/*
*/

        }
	$view->form = $form;
	$view->id =$id;
	return $view;
    
		
	}
    public function newAction()
    {
		$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	$log->info("new form");
		
	    $view = new ViewModel();
        $form = new WordageForm();
    	// 2015-09-10
    	// 2Do: Check to see that user is logged in
    	if (!$this->getAuthService()->hasIdentity())
        {
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/wordage/index');
        }
    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$log->info($this->username);
    	// 2Do: Implement Calendar Widget in Javascript for date and fix validation
        $form->get('submit')->setValue('Add');
        $wordage = new Wordage();

        $form->bind($wordage);
        $form->get('username')->setValue($this->username);
        $request = $this->getRequest();
		//$log->info($request);
        if ($request->isPost()) {
            $em = $this->getEntityManager();

            $inputFilter = $wordage->getInputFilter();
    
	    $form->setInputFilter($inputFilter);
	    $form->setData($request->getPost());
		$log->info(print_r($request->getPost(),true));
		//$theData = $form->getData();
		//$log->info(print_r($theData,true));
	    if ($form->isValid())
	    {
	       $log->info("is valid!");
		   $wordage->exchangeArray($request->getPost());
		   $log->info("data exchanged");
		   $log->info(print_r($form->getData(),true));
	       $em->persist($form->getData());
		   $log->info("persisted");
	       $em->flush();
		   $log->info("flushed");
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/wordage/index');
	    }

/*
*/

        }
	$view->form = $form;
	return $view;
    }
}
