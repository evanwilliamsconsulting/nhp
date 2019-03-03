<?php
namespace Application\Model;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Zend\Stdlib\ArrayObject as ArrayObject;


use Application\Model\ContainerItems as ContainerItems;
use Application\Entity\ContainerItems as ContainerItemObject;

class Containers extends AbstractResultSet
{
     private $itemArray;
     protected $em;
     protected $obj;
     protected $log;

     public function __construct()
     {
		$this->obj = new ArrayObject();
    }
/*
    public function setItems($someArray)
    {
	$this->itemArray = $someArray;
    }
    public function getItems()
    {
	return $this->itemArray;
    }
*/
    public function setLog($log)
    {
	$this->log = $log;
    }
    public function setEntityManager($em)
    {
    	$this->em = $em;
    }
	public function getEntityManager()
	{
		return $this->em;
	}
	public function loadDataSource()
	{
		$em = $this->getEntityManager();
		$containers = $em->getRepository('Application\Entity\Container')->findAll();
		$this->log->info(print_r($containers,true));

		foreach ($containers as $container)
		{
			$this->log->info(print_r($container,true));
			$this->log->info("Id");
			$this->log->info($container->getId());
			$this->log->info("username");
			$this->log->info($container->getUsername());
			$this->log->info("original");
			$this->log->info($container->getOriginalDate());
			$this->log->info("title");
			$this->log->info($container->getTitle());
			$this->log->info("background");
			$this->log->info($container->getBackground());
			$this->log->info("frame");
			$this->log->info($container->getFrame());
			$this->log->info("backgroundWidth");
			$this->log->info($container->getBackgroundWidth());
			$this->log->info("backgroundHeight");
			$this->log->info($container->getBackgroundHeight());

			// Find all Container Items for this Container;
			$containerId = $container->getId();
			$items = new ContainerItems();
			$items->setLog($this->log);
			$items->setEntityManager($this->em);
			$items->setContainerId($containerId);
			$items->loadDataSource();


			$itemArray = Array();
			$this->log->info("Ready to Process Container Items");
			foreach ($items->toArray() as $num => $item)
			{
				$newArray2 = $item;
				$this->log->info("Retrieved Container Items");
				$this->log->info(print_r($item,true));
				$itemArray[] = $newArray2;
				
			}

			$newArray = Array();
			$newArray["type"] = "Container";
			$newArray["object"] = $container;
			//$container->setItems(print_r($itemArray,true));
			$container->setItems($itemArray);
			$this->log->info(print_r($container,true));
			$this->obj->append($newArray);
			$this->log->info(print_r($newArray,true));
		}


	}
    public function getDataSource()
    {
	 	return $this->obj;
	 }
     public function getFieldCount()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->count();
	 }
     /** Iterator */
     public function next()
	 {
	 	$it = $this->obj->getIterator();
	    return $it->next();	
	 }
     public function key()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->key();
	 }
     public function current()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->current();
	 }
     public function valid()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->valid();
	 }
     public function rewind()
	 {
	 	$it = $this->obj->getIterator();
	 	return $it->rewind();
	 }
     /** countable */
     public function count()
	 {
	 	$it = $this->obj->getIterator();
		return $it->count();	 	
	 }
     public function getContainerItems()
     {
	return $this->itemArray;
     }
     /** get rows as array */
     public function toArray()
	 {
	 	$it = $this->obj->getIterator();
		$this->log->info(print_r($this->obj,true));
	   	$returnArray = $it->getArrayCopy();	
		return $returnArray;
	 }
}
?>
