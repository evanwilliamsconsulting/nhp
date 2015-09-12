<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;




/**
 * @ORM\Entity
 * @ORM\Table(name="Article")
 */
class Article 
{
    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->verbage= (isset($data['verbage'])) ? $data['verbage'] : null;
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
                'name' => 'verbage',
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
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $columnsize;

    /**
     * @var string
     */
    private $verbage;


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
     * Set columnsize
     *
     * @param integer $columnsize
     * @return Article
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

    /**
     * Set verbage
     *
     * @param string $verbage
     * @return Article
     */
    public function setVerbage($verbage)
    {
        $this->verbage = $verbage;

        return $this;
    }

    /**
     * Get verbage
     *
     * @return string 
     */
    public function getVerbage()
    {
        return $this->verbage;
    }
    /**
     * @var string
     */
    private $username;

    /**
     * @var \DateTime
     */
    private $original_date;

    /**
     * @var string
     */
    private $title;


    /**
     * Set username
     *
     * @param string $username
     * @return Article
     */
    public function setUsername($username)
    {
        $this->username = $username;

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
     * Set original_date
     *
     * @param \DateTime $originalDate
     * @return Article
     */
    public function setOriginalDate($originalDate)
    {
        $this->original_date = $originalDate;

        return $this;
    }

    /**
     * Get original_date
     *
     * @return \DateTime 
     */
    public function getOriginalDate()
    {
        return $this->original_date;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
