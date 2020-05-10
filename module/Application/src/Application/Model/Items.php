<?php
namespace Application\Model;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Zend\Stdlib\ArrayObject as ArrayObject;

class Items extends AbstractResultSet
{
    private $itemArray;
    protected $em;
    protected $obj;
    protected $log;
    protected $binderId;
    protected $useBinder;
    protected $criteria;

    public function __construct()
    {
	$this->obj = new ArrayObject();
	$this->useBinder = false;
    }
    public function setBinderId($binderId)
    {
	$this->useBinder = true;
	$this->binderId = $binderId;
	$this->criteria = array("binder_id" => $binderId);
    }
    public function setEntityManager($em)
    {
    	$this->em = $em;
    }
    public function getEntityManager()
    {
        return $this->em;
    }
    // Apparently each class needs to know how to fetch items relevant to that class!
    public function loadDataSource()
    {
	$useBinder = $this->useBinder;
	$criteria = $this->criteria;
	$em = $this->getEntityManager();

	if ($useBinder)
	{
		$wordages = $em->getRepository('Application\Entity\Wordage')->findBy($criteria);
	}
	else
	{
		$wordages = $em->getRepository('Application\Entity\Wordage')->findAll();
	}

	foreach	($wordages as $wordage)
	{
		$newArray = Array();
		$newArray["type"] = "Wordage";	
		$newArray["object"] = $wordage;
		$this->obj->append($newArray);
	}

	if ($useBinder)
	{
		$pictures = $em->getRepository('Application\Entity\Picture')->findBy($criteria);
	}
	else
	{
		$pictures = $em->getRepository('Application\Entity\Picture')->findAll();
	}

	foreach	($pictures as $picture)
	{
		$newArray = Array();
		$newArray["type"] = "Picture";	
		$newArray["object"] = $picture;
		$this->obj->append($newArray);
	}

	if ($useBinder)
	{
		$files = $em->getRepository('Application\Entity\File')->findBy($criteria);
	}
	else
	{
		$files = $em->getRepository('Application\Entity\File')->findAll();
	}

	foreach ($files as $file)
	{
		$newArray = Array();
		$newArray["type"] = "File";
		$newArray["object"] = $file;
		$this->obj->append($newArray);
	}

	if ($useBinder)
	{
		$experiences = $em->getRepository('Application\Entity\Experience')->findBy($criteria);
	}
	else
	{
		$experiences = $em->getRepository('Application\Entity\Experience')->findAll();
	}

	foreach ($experiences as $experience)
	{
		$newArray = Array();
		$newArray["type"] = "Experience";
		$newArray["object"] = $experience;
		$this->obj->append($newArray);
	}

	if ($useBinder)
	{
		$codebases = $em->getRepository('Application\Entity\CodeBase')->findBy($criteria);
	}
	else
	{
		$codebases = $em->getRepository('Application\Entity\CodeBase')->findAll();
	}

	foreach ($codebases as $codebase)
	{
		$newArray = Array();
		$newArray["type"] = "CodeBase";
		$newArray["object"] = $codebase;
		$this->obj->append($newArray);
	}

	if ($useBinder)
	{
		$codesamples = $em->getRepository('Application\Entity\CodeSample')->findBy($criteria);
	}
	else
	{
		$codesamples = $em->getRepository('Application\Entity\CodeSample')->findAll();
	}

	foreach ($codesamples as $codesample)
	{
		$newArray = Array();
		$newArray["type"] = "CodeSample";
		$newArray["object"] = $codesample;
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
