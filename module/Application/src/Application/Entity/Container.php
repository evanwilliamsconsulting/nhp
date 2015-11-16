<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="Container")
 */
class Container implements InputFilterAwareInterface
{
	   protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->original = (isset($data['original'])) ? $data['original'] : null;
        $this->title= (isset($data['title'])) ? $data['title'] : null;
        $this->background = (isset($data['background'])) ? $data['background'] : null;
        $this->backgroundwidth = (isset($data['backgroundwidth'])) ? $data['backgroundwidth'] : null;
        $this->backgroundheight = (isset($data['backgroundheight'])) ? $data['backgroundheight'] : null;
        $this->frame = (isset($data['frame'])) ? $data['frame'] : null;
    }
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
			$factory = new InputFactory();

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'id',
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
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'title',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'background',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'backgroundwidth',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'backgroundheight',
                'required' => false,
            )));
            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'frame',
                'required' => false,
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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var blob
	 * @ORM\Column(name="background", type="blob", nullable=false)
     */
    private $background;

    /**
     * @var boolean
	 * @ORM\Column(name="frame", type="boolean", nullable=false)
	 * 
	 */
    private $frame;

    /**
     * @var integer
	 * @ORM\Column(name="backgroundwidth", type="integer", nullable=false)
     */
    private $backgroundwidth;

    /**
     * @var integer
	 * @ORM\Column(name="backgroundheight", type="integer", nullable=false)
     */
    private $backgroundheight;
	/**
     * @var string
	 * 
	 * @ORM\Column(name="username", type="string", length=255, nullable=false)
     *
	 **/
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="original", type="string", length=255, nullable=false)
     */
    private $original;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=2255, nullable=false)
     */
    private $title;



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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set background
     *
     * @param string $background
     * @return Container
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string 
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set frame
     *
     * @param boolean $frame
     * @return Container
     */
    public function setFrame($frame)
    {
        $this->frame = $frame;

        return $this;
    }

    /**
     * Get frame
     *
     * @return boolean 
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * Set backgroundwidth
     *
     * @param integer $backgroundwidth
     * @return Container
     */
    public function setBackgroundwidth($backgroundwidth)
    {
        $this->backgroundwidth = $backgroundwidth;

        return $this;
    }

    /**
     * Get backgroundwidth
     *
     * @return integer 
     */
    public function getBackgroundwidth()
    {
        return $this->backgroundwidth;
    }

    /**
     * Set backgroundheight
     *
     * @param integer $backgroundheight
     * @return Container
     */
    public function setBackgroundheight($backgroundheight)
    {
        $this->backgroundheight = $backgroundheight;

        return $this;
    }

    /**
     * Get backgroundheight
     *
     * @return integer 
     */
    public function getBackgroundheight()
    {
        return $this->backgroundheight;
    }
    /**
     * @var integer
     */
    private $id;

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
     * @var string
     */
    private $background;

    /**
     * @var boolean
     */
    private $frame;

    /**
     * @var integer
     */
    private $backgroundwidth;

    /**
     * @var integer
     */
    private $backgroundheight;


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
     * @return Container
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
     * @return Container
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
     * @return Container
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
     * Set background
     *
     * @param string $background
     * @return Container
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string 
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set frame
     *
     * @param boolean $frame
     * @return Container
     */
    public function setFrame($frame)
    {
        $this->frame = $frame;

        return $this;
    }

    /**
     * Get frame
     *
     * @return boolean 
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * Set backgroundwidth
     *
     * @param integer $backgroundwidth
     * @return Container
     */
    public function setBackgroundwidth($backgroundwidth)
    {
        $this->backgroundwidth = $backgroundwidth;

        return $this;
    }

    /**
     * Get backgroundwidth
     *
     * @return integer 
     */
    public function getBackgroundwidth()
    {
        return $this->backgroundwidth;
    }

    /**
     * Set backgroundheight
     *
     * @param integer $backgroundheight
     * @return Container
     */
    public function setBackgroundheight($backgroundheight)
    {
        $this->backgroundheight = $backgroundheight;

        return $this;
    }

    /**
     * Get backgroundheight
     *
     * @return integer 
     */
    public function getBackgroundheight()
    {
        return $this->backgroundheight;
    }
}
