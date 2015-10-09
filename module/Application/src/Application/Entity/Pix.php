<?php


namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;




/**
 * @ORM\Entity
 * @ORM\Table(name="Pix")
 */
class Pix implements InputFilterAwareInterface
{
	protected $inputFilter;
	
	    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->credit= (isset($data['credit'])) ? $data['credit'] : null;
        $this->width= (isset($data['width'])) ? $data['width'] : null;
        $this->height= (isset($data['height'])) ? $data['height'] : null;
        $this->picture= (isset($data['picture'])) ? $data['picture'] : null;
        $this->columnSize = (isset($data['columnSize'])) ? $data['columnSize'] : null;
		$this->username = (isset($data['username'])) ? $data['username'] : null;
		$this->original = (isset($data['original'])) ? $data['original'] : null;
		$this->title = (isset($data['title'])) ? $data['title'] : null;
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
                'name' => 'credit',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'caption',
                'required' => false,
            )));

$inputFilter->add(
$factory->createInput(array(
'name' => 'picture',
'required' => false,
)));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'width',
                'required' => false,
            )));

            $inputFilter->add(
            	$factory->createInput(array(
                'name' => 'height',
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
     * @var string
     *
     * @ORM\Column(name="caption", type="string", length=255, nullable=false)
     */
    private $caption;

     /**
     * @var string
     *
     * @ORM\Column(name="credit", type="string", length=255, nullable=false)
     */
     private $credit;

     /**
     * @var string 
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=false)
     */
     private $picture;

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer", nullable=false)
     */
     private $width;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer", nullable=false)
     */
    private $height;


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
     * Set caption
     *
     * @return Pix
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string 
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set credit
     *
     * @return string
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return string 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set picture
     *
     * @return Pix
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Pix
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Pix
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;


    /**
     * Set username
     *
     * @param string $username
     * @return Pix
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
     * @return Pix
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
     * @return Pix
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
