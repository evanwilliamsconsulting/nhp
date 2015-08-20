<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Correspondant
 *
 * @ORM\Table(name="Correspondant")
 * @ORM\Entity
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

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($value)
    {
        $this->username = $value;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="handle", type="string", length=255, nullable=false)
     */
    private $handle;

    public function getHandle()
    {
        return $this->handle;
    }
    public function setHandle($value)
    {
        $this->handle = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="wordage", type="string", length=255, nullable=false)
     */
    private $wordage;
   
    public function getWordage()
    {
        return $this->wordage;
    }
    public function setWordage($value)
    {
        $this->wordage = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="blob", nullable=false)
     */
    private $picture;

    public function getPicture()
    {
        return $this->picture;
    }
    public function setPicture($value)
    {
        $this->picture = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer", nullable=false)
     */
    private $width;

    public function getWidth()
    {
        return $this->width;
    }
    public function setWidth($value)
    {
        $this->width = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer", nullable=false)
     */
    private $height;

    public function getHeight()
    {
        return $this->height;
    }
    public function setHeight($value)
    {
       $this->height = $value;
    }


}
