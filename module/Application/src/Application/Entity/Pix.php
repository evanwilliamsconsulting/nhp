<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table(name="Pix")
 * @ORM\Entity
 */
class Pix
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
     * @ORM\Column(name="caption", type="string", length=255, nullable=false)
     */
    private $caption;

    public function getCaption()
    {
        return $this->caption;
    }

    public function setCaption($value)
    {
        $this->caption = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="credit", type="string", length=255, nullable=false)
     */
    private $credit;

    public function getCredit()
    {
        return $this->credit;
    }

    public function setCredit($value)
    {
        $this->credit=$value;
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
        $this->width = $value
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
