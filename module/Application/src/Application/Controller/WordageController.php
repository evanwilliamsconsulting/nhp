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

class WordageController extends AbstractActionController
{
    protected $em;
 
    public function getEntityManager()
    {
        if (null == $this->em)
        {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	}
	return $this->em;
    }
    public function indexAction()
    {
	$view = new ViewModel();

	$articleView = new ViewModel(array('article' => $article));
        $articleView->setTemplate('content/article');

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
        $form->get('submit')->setValue('Add');
        $wordage = new Wordage();

        $form->bind($wordage);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $em = $this->getEntityManager();

            $inputFilter = new InputFilter();
    

            $inputFilter->add(array(
                'name' => 'wordage',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'columnSize',
                'required' => false,
	    ));

	    $form->setInputFilter($inputFilter);
	    $form->setData($request->getPost());
	    //print_r($request->getPost());
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
