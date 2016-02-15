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
use Application\Entity\Wordage;

use Application\View\Helper\WordageHelper as WordageHelper;
use Application\Service\WordageService as WordageService;

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

        $em = $this->getEntityManager();

	$layout = $this->layout();
	// This second layout look really should happen if logged in.
	$layout->setTemplate('layout/correspondant');

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
	}
	$view->items = $itemArray;

        return $view;
    }
}
