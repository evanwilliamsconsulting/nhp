<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="Correspondant")
 */
class Correspondant 
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
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="handle", type="string", length=255, nullable=false)
     */
    private $handle;

    /**
     * @var string
     * @ORM\Column(name="wordage", type="string", length=255, nullable=false)
     */
    private $wordage;

    /**
     * @var string
     * @ORM\Column(name="picture", type="string", length=255, nullable=false)
     */
    private $picture;

    /**
     * @var integer
     * @ORM\Column(name="width", type="integer", length=255, nullable=false)
     */
    private $width;

    /**
     * @var integer
     * @ORM\Column(name="height", type="integer", length=255, nullable=false)
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
     * Set username
     *
     * @param string $username
     * @return Correspondant
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
     * Set password
     *
     * @param string $password
     * @return Correspondant
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Correspondant
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set handle
     *
     * @param string $handle
     * @return Correspondant
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * Get handle
     *
     * @return string 
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Set wordage
     *
     * @param string $wordage
     * @return Correspondant
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
     * Set picture
     *
     * @param string $picture
     * @return Correspondant
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
     * @return Correspondant
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
     * @return Correspondant
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

    protected $inputFilter;

    public function exchangeArray($data)
    {

        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->handle = (isset($data['handle'])) ? $data['handle'] : null;
        $this->wordage = (isset($data['wordage'])) ? $data['wordage'] : null;
        $this->picture = (isset($data['picture'])) ? $data['picture'] : null;
        $this->width = (isset($data['width'])) ? $data['width'] : null;
        $this->height = (isset($data['height'])) ? $data['height'] : null;
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
                'name' => 'password',
                'required' => false,
            ));

            $inputFilter->add(array(
                'name' => 'email',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name' => 'handle',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name' => 'wordage',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name' => 'picture',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name' => 'width',
                'required' => false,
            ));
            $inputFilter->add(array(
                'name' => 'height',
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
