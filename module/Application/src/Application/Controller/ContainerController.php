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
/*
use Application\Entity\Container as ContainerType;

use Application\View\Helper\WordageHelper as WordageHelper;
use Application\Service\WordageService as WordageService;

use Application\View\Helper\PictureHelper as PictureHelper;
*/
use Application\View\Helper\ContainerHelper as ContainerHelper;

class ContainerController extends AbstractActionController
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
        $log->info("Container Controller");

    	$userSession = new Container('user'); // Talk about conflicting names!
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
		if ($new == "container")
		{
			$log->info("New Container");
			$newContainer = new Containers();
			$newContainer->setTitle("new");
			$newContainer->setUsername("ewilliams");
		        $log->info(print_r($newContainer,true));	
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('container');
		}
	}

	$log->info("Container / index moving on");
	// This second layout look really should happen if logged in.
	//$layout->setTemplate('layout/correspondant');

	$items = new Containers();
	$items->setLog($log);
	$items->setEntityManager($em);
	$items->loadDataSource();
		
	$view = new ViewModel();
		
	$itemArray = Array();
	$log->info("Ready to Process Items");
	foreach ($items->toArray() as $num => $item)
	{
		$log->info("Retrieved Items");
		$log->info(print_r($item,true));
		if ($item["type"] == "Container")
		{
			$log->info("process Container Item");
			$containerObject = $item["object"];
			$log->info(print_r($containerObject,true));
			$id = $containerObject->getId();
			$this->log->info("id");
			$this->log->info($containerObject->getId());
			$username = $containerObject->getUsername();
			$this->log->info("username");
			$this->log->info($containerObject->getUsername());
			$original = $containerObject->getOriginalDate();
			$this->log->info("original");
			$this->log->info($containerObject->getOriginalDate());
			$title = $containerObject->getTitle();
			$this->log->info("title");
			$this->log->info($containerObject->getTitle());
			$background = $containerObject->getBackground();
			$this->log->info("background");
			$this->log->info($containerObject->getBackground());
			$frame = $containerObject->getFrame();
			$this->log->info("frame");
			$this->log->info($containerObject->getFrame());
			$backgroundWidth = $containerObject->getBackgroundWidth();
			$this->log->info("backgroundWidth");
			$this->log->info($containerObject->getBackgroundWidth());
			$backgroundHeight = $containerObject->getBackgroundHeight();
			$this->log->info("backgroundHeight");
			$this->log->info($containerObject->getBackgroundHeight());
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
*/
	}
	$view->items = $itemArray;

	$log->info(print_r($view->items,true));
	
	$log->info("Ready to return view");

        return $view;
    }
}
