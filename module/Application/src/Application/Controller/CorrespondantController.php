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
use Application\Entity\Picture as Picture;
use Application\Entity\File as File;
use Application\Entity\CodeSample as CodeSample;

//use Application\Entity\Container as Bag;

use Application\View\Helper\WordageHelper as WordageHelper;
use Application\Service\WordageService as WordageService;

use Application\View\Helper\PictureHelper as PictureHelper;
use Application\View\Helper\FileHelper as FileHelper;
use Application\View\Helper\CodeHelper as CodeHelper;

use Application\View\Helper\Toolbar as Toolbar;


use Application\Model\Containers as Containers;
use Application\Entity\Container as ContainerObject;
use Application\View\Helper\ContainerHelper as ContainerHelper;

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
		//print_r($e);
		//print_r($e-getPrevious());
	    }
	}
	return $this->em;
    }
    public function containerAction()
    {
	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	$loggedIn = true;
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
			$newContainer->setUsername("evanwill");
			$newContainer->setBackgroundWidth(600);
			$newContainer->setBackgroundHeight(400);
			$em->persist($newContainer);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}

        }
    
        $em = $this->getEntityManager();


	$items = new Containers();
	$items->setLog($log);
	$items->setEntityManager($em);
	$items->loadDataSource();
		
	$view = new ViewModel();
		
	$itemArray = Array();
	foreach ($items->toArray() as $num => $item)
	{
		if ($item["type"] == "Container")
		{
			$containerObject = $item["object"];
			$id = $containerObject->getId();
			$username = $containerObject->getUsername();
			$original = $containerObject->getOriginalDate();
			$title = $containerObject->getTitle();
			$background = $containerObject->getBackground();
			$frame = $containerObject->getFrame();
			$backgroundWidth = $containerObject->getBackgroundWidth();
			$backgroundHeight = $containerObject->getBackgroundHeight();
			$bcolor = '#bb22bb';

			$view = new ViewModel(array('id' => $id,
				'username' => $username,
				'original' => $original,
				'title' => $title,
				'background' => $background,
				'backgroundWidth' => $backgroundWidth,
				'backgroundHeight' => $backgroundHeight,
				'frame' => $frame,
			));

			$containerItem = new ContainerHelper();
			$containerItem->setServiceLocator($this->getServiceLocator());
			$containerItem->setViewModel($view);
			$containerItem->setEntityManager($em);
			$containerItem->setContainerObject($item["object"]);
			$itemArray[] = $containerItem;
		}
	}
	$view->items = $itemArray;


	$toolbar = new Toolbar();
	$toolbar->setContext("containers");
	$view->toolbar = $toolbar;	
	$view->items = $itemArray;

        return $view;
    }
    public function indexAction()
    {
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	$loggedIn = true;
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
		if ($new == "wordage")
		{
			$newWordage = new Wordage();
			$newWordage->setTitle("new");
			$newWordage->setUsername("evanwill");
			$em->persist($newWordage);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "picture")
		{
			$newPicture = new Picture();
			$newPicture->setTitle("new");
			$newPicture->setUsername("evanwill");
			$newPicture->setCredit("EJW");
			$newPicture->setWidth(150);
			$newPicture->setHeight(150);
			$em->persist($newPicture);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "file")
		{
			$newFile = new File();
			$newFile->setUsername("evanwill");
			$newFile->setFilename("test");
			$newFile->setFilepath("/filestore");
			$newFile->setAuthor("EJW");
			$em->persist($newFile);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
		else if ($new == "code")
		{
			$newCodeSample = new CodeSample();
			$newCodeSample->setUsername("evanwill");
			$em->persist($newCodeSample);
			$em->flush();

			return $this->redirect()->toRoute('correspondant');
		}
	}

	// This second layout look really should happen if logged in.
	//$layout->setTemplate('layout/correspondant');

	$items = new Items();
	$items->setEntityManager($em);
	$items->loadDataSource();
		
	$view = new ViewModel();
		
	$itemArray = Array();
	foreach ($items->toArray() as $num => $item)
	{
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
		else if ($item["type"] == "Picture")
		{
			$pictureObject = $item["object"];
			$picture = $pictureObject->getPicture();
			$id = $pictureObject->getId();
			$original = $pictureObject->getOriginal();
			$caption = $pictureObject->getTitle();
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
		else if ($item["type"] == "File")
		{
			$fileObject = $item["object"];
			$filename = $fileObject->getFilename();
			$filepath = $fileObject->getFilepath();
			$id = $fileObject->getId();
			$original = $fileObject->getOriginal();
			$author = $fileObject->getAuthor();
			$username = $fileObject->getUsername();
			$bcolor = '#00bbb0';
			$view = new ViewModel(array('filename' => $filename,
				'filepath' => $filepath,
				'id' => $id,
				'original' => $original,
				'author' => $author,
				'username' => $username,
				'bcolor' => $bcolor
			));
			$fileItem = new FileHelper();
			$fileItem->setServiceLocator($this->getServiceLocator());
			$fileItem->setViewModel($view);
			$fileItem->setFileObject($item["object"]);
			$itemArray[] = $fileItem;
		}
		else if ($item["type"] == "CodeSample")
		{
			$codeObject = $item["object"];
			$fileid = $codeObject->getFileId();
			$firstLine = $codeObject->getFirstLine();
			$lastLine = $codeObject->getLastLine();
			$title = $codeObject->getTitle();
			$code = $codeObject->getCode();
			$language = $codeObject->getLanguage();	
			$view = new ViewModel(array('fileid' => $fileid,
				'id' => $id,
				'fileid' => $fileid,
				'first_line' => $firstLine,
				'last_line' => $lastLine,
				'title' => $title,
				'code' => $code,
				'language' => $language,
				'original' => $original,
				'username' => $username,
				'bcolor' => $bcolor
			));
			$codeItem = new CodeHelper();
			$codeItem->setServiceLocator($this->getServiceLocator());
			// What do you suppose that the Service Locator does?
			$codeItem->setViewModel($view);
			$codeItem->setCodeObject($item["object"]);
			$itemArray[] = $codeItem;

		}
	}

	$toolbar = new Toolbar();
	$toolbar->setContext("objects");
	$view->toolbar = $toolbar;	
	$view->items = $itemArray;
	

        return $view;
    }
}
