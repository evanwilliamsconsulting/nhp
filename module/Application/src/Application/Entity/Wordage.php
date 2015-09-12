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
    private $columnsize;


    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->original = (isset($data['original'])) ? $data['original'] : null;
        $this->title= (isset($data['title'])) ? $data['title'] : null;
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
                'name' => 'username',
                'required' => false,
            ));

            $inputFilter->add(array(
                'name' => 'original',
                'required' => false,
                'validators' => array(
                array(
                'name' => 'Date',
                'options' => array(
                    'format' => 'm/d/Y',
                    'locale' => 'en',
                    'messages' => array(
                        \Zend\Validator\Date::INVALID => 'Invalid Entry',
                        \Zend\Validator\Date::INVALID_DATE => ' (Invalid Date)',
                        \Zend\Validator\Date::FALSEFORMAT => 'Invalid Format.',
                        ),
                    ),
                ),
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                    'messages' => array(
                        \Zend\Validator\NotEmpty::IS_EMPTY => 'Empty'
                        ),
                    ),
                )
				)
            ));

            $inputFilter->add(array(
                'name' => 'title',
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
	 * 
     * @ORM\Column(name="columnSize", type="integer", length=255, nullable=false)
     * @var integer
     */
    private $columnSize;
	
    /**
     * @var string
	 * 
	 * @ORM\Column(name="username", type="string", length=255, nullable=false)
     *
	 **/
    private $username;

    /**
     * @var \Date
	 * 
	 * @ORM\Column(name="original", type="datetime", nullable=false)
     */
    private $original;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=2255, nullable=false)
     */
    private $title;

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
     * Set username
     *
     * @param string $username
     * @return Wordage
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
     * @param \DateTime $original
     * @return Wordage
     */
    public function setOriginalDate($originalDate)
    {
        $this->original = $originalDate;

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
     * Set title
     *
     * @param string $title
     * @return Wordage
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
}
