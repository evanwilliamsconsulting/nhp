<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;

/**
 *
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="itemtype",type="string")
 * @ORM\DiscriminatorMap({"container" = "ContainerItems","schematic" = "SchematicParts"})
 * @ORM\Table(name="ContainerItems")
 *
 *
 *
 *
 */

class ContainerItems implements InputFilterAwareInterface
{
    private $columnsize;


    protected $inputFilter;
    protected $em;

    public function exchangeArray($data)
    {
        $this->containerid = (isset($data['containerid'])) ? $data['containerid'] : null;
        $this->itemid = (isset($data['itemid'])) ? $data['itemid'] : null;
        $this->itemtype = (isset($data['itemtype'])) ? $data['itemtype'] : null;
	$this->original = (isset($data['original'])) ? $data['original'] : null;
	$this->username = (isset($data['username'])) ? $data['username'] : null;
    }
    public function setEntityManager($em)
    {
	$this->em = $em;
    }
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
			$factory = new InputFactory();

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'containerid',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'itemid',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'itemtype',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'username',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'original',
                'required' => false,
                'options' => array(
                	'format' => 'Ymd'
				)
            )));

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not Used");
    }
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="containerid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $containerid;

    /**
     * @var integer
     *
     * @ORM\Column(name="itemid", type="integer", nullable=false)
     */
    private $itemid;


    private $itemtype;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="original", type="string", length=255, nullable=false)
     */
    private $original;


    /**
     * Get container id
     *
     * @return integer 
     */
    public function getContainerId()
    {
        return $this->containerid;
    }

    /*
     *   Set container id
     *
     *   @param int $containerid
     *   @return ContainerItem
     *
     */ 
    public function setContainerId($containerid)
    {
	$this->containerid = $containerid;
	return $this;
    }
    /**
     * Get item id
     *
     * @return integer 
     */
    public function getItemId()
    {
        return $this->itemid;
    }

    /**
     * Set item id
     *
     * @param int itemid
     * @return ContainerItem
     *
     */
    public function setItemId($itemid)
    {
        $this->itemid = $itemid;
        return $this;
    }

    /**
     * Get itemtype 
     *
     * @return string 
     */
    public function getItemType()
    {
        return $this->itemtype;
    }

    /**
     * Set itemtype 
     *
     * @param string $itemtype
     * @return ContainerItem
     */
    public function setItemType($itemtype)
    {
        $this->itemtype = $itemtype;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return ContainerItem
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get original_date
     *
     * @return \DateTime 
     */
    public function getOriginalDate()
    {
        return $this->original;
    }

    /**
     * Set original_date
     *
     * @param \DateTime $originalDate
     * @return ContainerItem
     */
    public function setOriginalDate($originalDate)
    {
        $this->original = $originalDate;

        return $this;
    }
}
