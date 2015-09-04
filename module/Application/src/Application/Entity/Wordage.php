<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="Wordage")
 */
class Wordage implements InputFilterAwareInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="wordage", type="string", length=255, nullable=false)
     */
    private $wordage;

    /**
     *
     * @ORM\Column(name="columnSize", type="integer", length=255, nullable=false)
     * @var integer
     */
    private $columnsize;


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
     * Set wordage
     *
     * @param string $wordage
     * @return Wordage
     */
    public function setWordage($wordage)
    {
        $this->wordage = $wordage;

        return $this;
    }

    /**
     * Get wordage
     *
     * @return string 
     */
    public function getWordage()
    {
        return $this->wordage;
    }

    /**
     * Set columnsize
     *
     * @param integer $columnsize
     * @return Wordage
     */
    public function setColumnsize($columnsize)
    {
        $this->columnsize = $columnsize;

        return $this;
    }

    /**
     * Get columnsize
     *
     * @return integer 
     */
    public function getColumnsize()
    {
        return $this->columnsize;
    }

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->wordage = (isset($data['wordage'])) ? $data['wordage'] : null;
        $this->columnSize = (isset($data['columnSize'])) ? $data['columnSize'] : null;
    }
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'id',
                'required' => false,
            ));

            $inputFilter->add(array(
                'name' => 'wordage',
                'required' => false,
            ));

            $inputFilter->add(array(
                'name' => 'columnSize',
                'required' => false,
            ));
 
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
}
