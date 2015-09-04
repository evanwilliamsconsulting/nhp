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
use Application\Entity\Correspondant;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\CorrespondantForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;

class CorrespondantController extends AbstractActionController
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

	$view->content = $this->content();

        return $view;
    }
    public function content()
    {
	return "content";
    }
    public function correspondantAction()
    {
	$view = new ViewModel();
        $view->content = $this->content();
        return $view;
    }
    public function newAction()
    {
	$view = new ViewModel();
        $form = new CorrespondantForm();
        $form->get('submit')->setValue('Add');
        $correspondant= new Correspondant();

        $form->bind($correspondant);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $em = $this->getEntityManager();

            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'username',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'password',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'email',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'handle',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'wordage',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'picture',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'width',
                'required' => false,
	    ));
            $inputFilter->add(array(
                'name' => 'height',
                'required' => false,
	    ));

	    $form->setInputFilter($inputFilter);
	    $form->setData($request->getPost());
	    //print_r($request->getPost());
	    if ($form->isValid())
	    {
	       $em->persist($correspondant);
	       $em->flush();
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/correspondant/index');
	    }

/*
*/

        }
	$view->form = $form;
	return $view;
    }
}
