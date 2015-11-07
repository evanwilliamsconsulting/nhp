<?php
namespace Application\Model;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Zend\Stdlib\ArrayObject as ArrayObject;

class Item extends AbstractResultSet{
	 protected $em;
	 protected $wordage;
	 protected $obj;
         protected $log;

     public function __construct($log)
     {
          $this->log = $log;
     }
	 
     public function initialize($em) 
	 {
	 	$this->em = $em;
		//$this->log->info(print_r($em,true));
		$this->wordage = $this->em->getRepository('Application\Entity\Wordage');
		//$this->log->info(print_r($em,true));
		//$this->pix = $this->em->getRepository('Application\Entity\Pix');
		$this->obj = new ArrayObject($this->wordage->findAll());
		//$this->obj = new ArrayObject();
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
     /** get rows as array */
     public function toArray()
	 {
	 	$it = $this->obj->getIterator();
	    return $it->getArrayCopy();	
	 }
}
?>
