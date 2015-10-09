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

use Doctrine\ORM\EntityManager;
use Application\Form\Entity\CorrespondantForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;

use Application\Entity\Correspondant;
use Application\Entity\Wordage;

use Application\View\Helper\PixHelper;



class CorrespondantController extends AbstractActionController
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
    	// Retrieve Log
    	$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	
		$log->info("Correspondant Controller");
    	// Am I logged in?
    	// If not redirect to home page.
    	if (!$this->getAuthService()->hasIdentity())
        {
	       return $this->redirect()->toUrl('http://www.newhollandpress.com/');
        }
		// If I am logged in then
		// Get the username from the session.
		// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$log->info($this->username);
		
		// Now ready the View Model
	    $view = new ViewModel();

		// There are three basic views that the Correspondant might want to see.
		// 1. Profile
		// 2. List of Contributions
		// 3. Layouts
		
		// We want to keep things exciting, but for now, let's just return the list.
		// Later, if there are no contributions we start at the profile,
		// If we have contributions we look at the list
		// If we have just edited something we return to the view of that item
		// And if we are starting to lay out an article with a Headline and all that, why not go there?
		
		// To return a list we must retrieve all content types that pertain to this username and sort.
		// This is not clean.  As content types grow (we might add Crossword puzzles and Horoscopes and
		// Comics and FAQs and many other types of content) there should be many sources of content, and,
		// These would preferably be in more places than Yet Another Database Table (YADT).
		
		// Might want to think about what Classes and Interfaces would help us to represent that?
		
		// For now we must retrieve all Wordage, Articles and Pix.
		$em = $this->getEntityManager();
		
		$wordage = $em->getRepository('Application\Entity\Wordage')->findAll();
		
		$log->info("Retrieved Wordage");
		
		$output = "<h1>Wordage</h1>";
		$output.="<br/>";

		$wordageHelpers = array();
		$counter = 1;
		foreach ($wordage as $wordageObject)
		{
			$idcode = "wordage" . $counter;
			$aWordageHelper = new \Application\View\Helper\WordageHelper();
			$aWordageHelper->setWordageObject($wordageObject);
			$aWordageHelper->setUsername($this->username);
			$aWordageHelper->setItemId($idcode);
			$counter += 1;
			$wordageHelpers[$idcode]=$aWordageHelper;
		}
		foreach ($wordage as $wordageObject)
		{
			$base = 'https://newhollandpress.com/wordage/view/';
			$title = $wordageObject->getTitle();
			$id = $wordageObject->getId();
			$base .= $id;
			$output .= "<a href='" . $base . "'>" . $title . "</a>";
			$output .= "<p>";
			$output .= $wordageObject->getWordage();
			$output .= "</p>";
			$output .= "<br/>";
		}
		$output .= "<br/>";

		$articles = $em->getRepository('Application\Entity\Article')->findAll();
		
		$log->info("Retrieved Article");
		
		$output .= "<h1>Article</h1>";
		$output.="<br/>";
		
		foreach ($articles as $articleObject)
		{
			$id = $articleObject->getId();
			$title = $articleObject->getTitle();
			$base = 'https://newhollandpress.com/article/view/';
			$base .= urlencode($id);
			$output .= "<a href='" . $base . "'>" . $title . "</a>";
			$output .= "<p>";
			$output .= $articleObject->getVerbage();
			$output .= "</p>";
			$output .= "<br/>";
		}
		$output .= "<br/>";

		$pix = $em->getRepository('Application\Entity\Pix')->findAll();
		
		$log->info("Retrieved Pix");
		
		$output .= "<h1>Pix</h1>";
		$output.="<br/>";

		$outputHelpers = array();
		$counter = 1;
		foreach ($pix as $pixObject)
		{
			$idcode = "pix" . $counter;
			$aPixHelper = new \Application\View\Helper\PixHelper();
			$aPixHelper->setPixObject($pixObject);
			$aPixHelper->setUsername($this->username);
			$aPixHelper->setItemId($idcode);
			$counter += 1;
			$outputHelpers[$idcode]=$aPixHelper;
		}
		$output .= "<br/>";

		$containers = $em->getRepository('Application\Entity\Container')->findAll();
		
		$log->info("Retrieved Container");
		
		$output .= "<h1>Container</h1>";
		$output.="<br/>";

		foreach ($containers as $containerObject)
		{
			$output .= "<p>";
			$id = $containerObject->getId();
			$title = $containerObject->getTitle();
			$base = 'https://newhollandpress.com/container/view/';
			$base .= urlencode($id);
			$output .= "<a href='" . $base . "'>" . $title . "</a>";
			$output .= "</p>";
			$output .= "<br/>";
		}
		$output .= "<br/>";


		$view->wordageHelpers = $wordageHelpers;
		$view->outputHelpers = $outputHelpers;
		
        return $view;
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
