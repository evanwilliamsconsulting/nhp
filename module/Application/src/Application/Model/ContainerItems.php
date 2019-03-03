<?php
namespace Application\Model;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Zend\Stdlib\ArrayObject as ArrayObject;

use Application\Model\ContainerItems as ContainerItems;
use Application\Entity\ContainerItems as ContainerItemObject;

class ContainerItems extends AbstractResultSet
{
     private $itemArray;
     protected $em;
     protected $obj;
     protected $log;
     protected $containerId;

     public function __construct()
     {
		$this->obj = new ArrayObject();
    }
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
		$containerId = $this->containerId;
		$criteria = Array();
		$criteria["containerid"] = $containerId;
		$containers = $em->getRepository('Application\Entity\ContainerItems')->findBy($criteria);
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
			$newArray = Array();
			$newArray["type"] = "ContainerItem";
			$newArray["object"] = $container;
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
     public function setContainerId($id)
     {
	$this->containerId = $id;
     }
     public function getContainerId()
     {
	return $this->containerId;
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
     /** get rows as array */
     public function toArray()
	 {
	 	$it = $this->obj->getIterator();
		$this->log->info(print_r($this->obj,true));
	   return $it->getArrayCopy();	
	 }
}
?>
