<?php


namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;



/**
 * @ORM\Entity
 * @ORM\Table(name="Block")
 */
class Block 
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \stdClass
     */
    private $containerreference;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set containerreference
     *
     * @param \stdClass $containerreference
     * @return Block
     */
    public function setContainerreference($containerreference)
    {
        $this->containerreference = $containerreference;

        return $this;
    }

    /**
     * Get containerreference
     *
     * @return \stdClass 
     */
    public function getContainerreference()
    {
        return $this->containerreference;
    }
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \stdClass
     */
    private $containerreference;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set containerreference
     *
     * @param \stdClass $containerreference
     * @return Block
     */
    public function setContainerreference($containerreference)
    {
        $this->containerreference = $containerreference;

        return $this;
    }

    /**
     * Get containerreference
     *
     * @return \stdClass 
     */
    public function getContainerreference()
    {
        return $this->containerreference;
    }
}
