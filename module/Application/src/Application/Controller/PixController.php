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
use Application\Entity\Pix;
use Application\Form\Entity\PixForm;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\Validator\File\Size;

class PixController extends AbstractActionController
{
    public function indexAction()
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
    public function getForm()
    {
        $form = new PixForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
        }
	return $form;
    }
   public function newAction()
    {
	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	$log->info("new form");
	$view = new ViewModel();
        $form = new PixForm();
    	// 2015-09-10
    	// 2Do: Check to see that user is logged in
    	if (!$this->getAuthService()->hasIdentity())
        {
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/pix/index');
        }
    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$log->info($this->username);
    	// 2Do: Implement Calendar Widget in Javascript for date and fix validation
        $form->get('submit')->setValue('Add');
        $pix = new Pix();

        $form->bind($pix);
        $form->get('username')->setValue($this->username);
        $request = $this->getRequest();
		//$log->info($request);
        if ($request->isPost()) {
            $em = $this->getEntityManager();

            $inputFilter = $pix->getInputFilter();
    
	    $form->setInputFilter($inputFilter);
	    $form->setData($request->getPost());
	    $log->info(print_r($request->getPost(),true));
	    if ($form->isValid())
	    {
			$pix->exchangeArray($request->getPost());
			$log->info("data exchanged");
			$log->info(print_r($form->getData(),true));
	    	/* Untested code to upload pix 
			 * https://samsonasik.wordpress.com/2012/08/31/zend-framework-2-creating-upload-form-file-validation/
	    	$size = new Size(array('min'=>1000000));
			$adapter = new \Zend\File\Transfer\Adapter\Http();
			
	       $log->info("is valid!");
		   $post = $request->getPost();
		   $filename = $post['filename'];
		   $adapter->setValidators($size,$filename);
		   if ($adapter->isValid()) {
		   	  $adapter->receive($File['name']) {
			 *   $profile->exchangeArray($form->getData());
			 * }
		   }
			 * *
			 */
	       $em->persist($form->getData());
		$log->info("persisted");
	       $em->flush();
		$log->info("flushed");
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/pix/index');
	    }
        }
	$view->form = $form;
	return $view;
    }
}
