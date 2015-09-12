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
        $form->get('username')->setValue($this->username);
    	// 2Do: Implement Calendar Widget in Javascript for date and fix validation
        $form->get('submit')->setValue('Add');
        $wordage = new Wordage();

        $form->bind($wordage);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $em = $this->getEntityManager();

            $inputFilter = $wordage->getInputFilter();
    
	    $form->setInputFilter($inputFilter);
	    $form->setData($request->getPost());
	    if ($form->isValid())
	    {
	       $em->persist($wordage);
	       $em->flush();
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/wordage/index');
	    }

/*
*/

        }
	$view->form = $form;
	return $view;
    }
}
