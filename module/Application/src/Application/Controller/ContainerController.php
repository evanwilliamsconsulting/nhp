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

use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\Entity\Wordage as Wordage;


use Application\Model\Items as Items;
use Application\Entity\Picture as Picture;
use Application\Entity\File as File;
use Application\Entity\CodeSample as CodeSample;
use Application\Entity\Experience as Experience;

use Application\Entity\Container as Bag;
use Application\Entity\Schematic as Schematic;
use Application\Entity\Lesson as Lesson;
use Application\Entity\Graphic as Graphic;

use Application\View\Helper\WordageHelper as WordageHelper;
use Application\Service\WordageService as WordageService;

use Application\View\Helper\PictureHelper as PictureHelper;
use Application\View\Helper\FileHelper as FileHelper;
use Application\View\Helper\CodeHelper as CodeHelper;
use Application\View\Helper\ExperienceHelper as ExperienceHelper;

use Application\View\Helper\HeadlineHelper as HeadlineHelper;

use Application\View\Helper\Toolbar as Toolbar;


use Application\View\Helper\ContainerHelper as ContainerHelper;

class ContainerController extends AbstractActionController
{
    protected $em;
    protected $authservice;
    protected $username;
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
    public function viewAction()
    {
	$view = new ViewModel();

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
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
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

        $em = $this->getEntityManager();

	$new = $this->params()->fromQuery('new');

	if (!is_null($new))
	{
		if ($new == "container")
		{
			$newContainer = new Bag();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("container");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "schematic")
                {
			$newContainer = new Schematic();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("schematic");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "lesson")
                {
			$newContainer = new Lesson();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("lesson");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "graphic")
                {
			$newContainer = new Graphic();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("graphic");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();
		}
        }
    
        $em = $this->getEntityManager();


        $repository = $em->getRepository('Application\Entity\Container');
	$theItems = $repository->findAll();
	$numItems = count($theItems);
	$i = 0;

		$theObject = $theItems[$i];

		$containerItem = new ContainerHelper();
		$containerItem->setEntityManager($em);
		$containerItem->setServiceLocator($this->getServiceLocator());
		$containerItem->setViewModel($view);
		$containerItem->setContainerObject($theObject);
		$html .= $containerItem->toHTML();

	$html .= "<br/>";
	$html .= $numItems;
	$html .= "<br/>";
	$view->content = $html;

        return $view;
    }
    public function listAction()
    {
	$view = new ViewModel();

	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
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
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}

        $em = $this->getEntityManager();

	$new = $this->params()->fromQuery('new');

	if (!is_null($new))
	{
		if ($new == "container")
		{
			$newContainer = new Bag();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("container");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "schematic")
                {
			$newContainer = new Schematic();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("schematic");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "lesson")
                {
			$newContainer = new Lesson();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("lesson");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "graphic")
                {
			$newContainer = new Graphic();
			$newContainer->setTitle("new");
			$newContainer->setContainerType("graphic");
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();
		}
        }
    
        $em = $this->getEntityManager();


        $repository = $em->getRepository('Application\Entity\Container');
	$theItems = $repository->findAll();
	$numItems = count($theItems);
	$i = 0;

		$theObject = $theItems[$i];

		$containerItem = new ContainerHelper();
		$containerItem->setEntityManager($em);
		$containerItem->setServiceLocator($this->getServiceLocator());
		$containerItem->setViewModel($view);
		$containerItem->setContainerObject($theObject);
		$html .= $containerItem->toHTML();

	$html .= "<br/>";
	$html .= $numItems;
	$html .= "<br/>";
	$view->content = $html;

        return $view;
    }
    public function indexAction()
    {

    	$userSession = new Container('user'); // Talk about conflicting names!
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
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
	       return $this->redirect()->toUrl('https://www.evtechnote.us/');
	}
    
        $em = $this->getEntityManager();

	$new = $this->params()->fromQuery('new');

	if (!is_null($new))
	{
		if ($new == "container")
		{
			$newContainer = new Containers();
			$newContainer->setTitle("new");
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('container');
		}
	}

	// This second layout look really should happen if logged in.
	//$layout->setTemplate('layout/correspondant');

	$items = new Containers();
	$items->setEntityManager($em);
	$items->loadDataSource();
		
	$view = new ViewModel();
		
	$itemArray = Array();
	foreach ($items->toArray() as $num => $item)
	{
		//$log->info(print_r($item,true));
		if ($item["type"] == "Container")
		{
			//log->info("process Container Item");
			$containerObject = $item["object"];
			//$log->info(print_r($containerObject,true));
			$id = $containerObject->getId();
			$username = $containerObject->getUsername();
			$original = $containerObject->getOriginalDate();
			$title = $containerObject->getTitle();
			$background = $containerObject->getBackground();
			$frame = $containerObject->getFrame();
			$backgroundWidth = $containerObject->getBackgroundWidth();
			$backgroundHeight = $containerObject->getBackgroundHeight();
/*
			$itemArray["id"] = $id;
			$itemArray["username"] = $username;
			$itemArray["original"] = $original;
			$itemArray["title"] = $title;
			$itemArray["background"] = $background;
			$itemArray["backgroundWidth"] = $backgroundWidth;
			$itemArray["backgroundHeight"] = $backgroundHeight;
			$itemArray["frame"] = $frame;
*/
			$bcolor = '#bb22bb';
			$view = new ViewModel(array('id' => $id,
				'username' => $username,
				'original' => $original,
				'title' => $title,
				'background' => $background,
				'backgroundWidth' => $backgroundWidth,
				'backgroundHeight' => $backgroundHeight,
				'frame' => $frame
			));
			$containerItem = new ContainerHelper();
			$containerItem->setServiceLocator($this->getServiceLocator());
			$containerItem->setViewModel($view);
			$containerItem->setContainerObject($item["object"]);
			$itemArray[] = $containerItem;
		}
/*
		if ($item["type"] == "Wordage")
		{
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
*/
	}
	$view->items = $itemArray;

	

        return $view;
    }
}
