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

		foreach ($containers as $container)
		{
			$newArray = Array();
			$newArray["type"] = "ContainerItem";
			$newArray["object"] = $container;
			$this->obj->append($newArray);
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
	   return $it->getArrayCopy();	
	 }
}
?>
