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
use Application\Entity\Article;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\ArticleForm;

class ArticleController extends AbstractActionController
{
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
    public function getForm()
    {
        $form = new ArticleForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
        }
	return $form;
    }
    public function newAction()
    {
	$view = new ViewModel();
        $form = new ArticleForm();
        $form->get('submit')->setValue('Add');
        $wordage = new Article();

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
			$inputFilter->add(array(
				'name' => 'original_date',
				'required' => false
		));

	    $form->setInputFilter($inputFilter);
	    $form->setData($request->getPost());
	    //print_r($request->getPost());
	    if ($form->isValid())
	    {
	       $em->persist($wordage);
	       $em->flush();
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/article/index');
	    }

/*
*/

        }
	$view->form = $form;
	return $view;
    }
}
