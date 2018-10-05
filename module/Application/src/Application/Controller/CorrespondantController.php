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
use Zend\Stdlib\ArrayObject as ArrayObject;

use Application\Model\Items as Items;
use Application\Entity\Wordage as Wordage;

use Application\View\Helper\WordageHelper as WordageHelper;
use Application\Service\WordageService as WordageService;

use Application\View\Helper\PictureHelper as PictureHelper;

class CorrespondantController extends AbstractActionController
{
    protected $em;
    protected $authservice;
    protected $username;
    protected $log;
    protected $obj;

    public function __construct()
    {
    }
    public function getEntityManager()
    {
        if (null == $this->em)
        {
	    try {
            	$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                //$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            } catch (Exception $e) {
		print_r($e);
		print_r($e-getPrevious());
	    }
	}
	return $this->em;
    }
    public function indexAction()
    {
	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
        $log->info("Correspondant Controller");

    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$log->info($this->username);
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		$log->info("Logged In");
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($this->username);
			}
	}
	else
	{
		$log->info("Not Logged In");
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}
    
        $em = $this->getEntityManager();

	$new = $this->params()->fromQuery('new');

	if (!is_null($new))
	{
		$log->info("There Was Something New");
		if ($new == "wordage")
		{
			$log->info("New Wwordage");
			$newWordage = new Wordage();
			$newWordage->setTitle("new");
			$newWordage->setUsername("evanwill");
			$newWordage->setWordage("new");
			$newWordage->setColumnsize("65");
		        $log->info(print_r($newWordage,true));	
			$em->persist($newWordage);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
	}

	$log->info("Correspondant / index moving on");
	// This second layout look really should happen if logged in.
	//$layout->setTemplate('layout/correspondant');

	$items = new Items();
	$items->setEntityManager($em);
	$items->loadDataSource();
		
	$view = new ViewModel();
		
	$itemArray = Array();
	$log->info("Ready to Process Items");
	foreach ($items->toArray() as $num => $item)
	{
		$log->info("Retrieved Items");
		if ($item["type"] == "Wordage")
		{
			$log->info("Process Wordage Item");
			$wordageObject = $item["object"];
			$wordage = $wordageObject->getWordage();
			$id = $wordageObject->getId();
			$original = $wordageObject->getOriginal();
			$title = $wordageObject->getTitle();
			$username = $wordageObject->getUsername();
			$bcolor = '#ff22bb';
			$view = new ViewModel(array('wordage' => $wordage,
				'id' => $id,
				'original' => $original,
				'title' => $title,
				'username' => $username,
				'bcolor' => $bcolor
			));
			$wordageItem = new WordageHelper();
			$wordageItem->setServiceLocator($this->getServiceLocator());
			$wordageItem->setViewModel($view);
			$wordageItem->setWordageObject($item["object"]);
			$itemArray[] = $wordageItem;
		}
		else 
		{
			$log->info("Process Picture Object");
			$pictureObject = $item["object"];
			$picture = $pictureObject->getPicture();
			$id = $pictureObject->getId();
			$original = $pictureObject->getOriginal();
			$caption = $pictureObject->getCaption();
			$username = $pictureObject->getUsername();
			$bcolor = '#00bbbb';
			$view = new ViewModel(array('picture' => $picture,
				'id' => $id,
				'original' => $original,
				'caption' => $caption,
				'username' => $username,
				'bcolor' => $bcolor
			));
			$pictureItem = new PictureHelper();
			$pictureItem->setServiceLocator($this->getServiceLocator());
			$pictureItem->setViewModel($view);
			$pictureItem->setPictureObject($item["object"]);
			$itemArray[] = $pictureItem;
		}		
	}
	$view->items = $itemArray;
	
	$log->info("Ready to return view");

        return $view;
    	$log->info("Return from correspondant index");
    }
}
