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
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	}
	return $this->em;
    }
    public function indexAction()
    {
	    $this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
        $log->info("Correspondant Controller");

        $em = $this->getEntityManager();
	
		$items = new Items();
		$items->setEntityManager($em);
		$items->loadDataSource();
		
//		$wordage = $em->getRepository('Application\Entity\Wordage')->findAll();
	
	    $view = new ViewModel();
		
//		$items = $wordage;

	    $view->items = $items->toArray();

        return $view;
    }
}
