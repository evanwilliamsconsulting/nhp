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

use Application\Model\Item as Item;

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
    public function indexAction()
    {
    	// Retrieve Log
       	$em = $this->getEntityManager();
        // TODO: Implement findAllItems() method.
        $item = new Item($em);
        //$em = $this->getEntityManager();
		
		//$wordage= $em->getRepository('Application\Entity\Wordage')->findAll();
		
		//return $wordage;
		$itemArray = $item->toArray();	
		$this->log = $this->getServiceLocator()->get('log');
    	$log = $this->log;
    	$log->info("Correspondant Controller");
		$view = new ViewModel();

        $view->content = print_r($itemArray,true);
		$view->items = $item;
        
        return $view;
		
    }
}