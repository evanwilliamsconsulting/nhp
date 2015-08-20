<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Container
 *
 * @ORM\Table(name="Container")
 * @ORM\Entity
 */
class Container
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
     * @ORM\Column(name="background", type="blob", nullable=false)
     */
    private $background;

    public function getBackground()
    {
        return $this->background;
    }
    public function setBackground($value)
    {
        $this->background = $value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="frame", type="boolean", nullable=false)
     */
    private $frame;

    public function getFrame()
    {
        return $this->frame;
    }
    public function setFrame($value)
    {
        $this->frame = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="backgroundwidth", type="integer", nullable=false)
     */
    private $backgroundwidth;

    public function getBackgroundwidth()
    {
        return $this->backgroundwidth;
    }
    public function setBackgroundwidth($value)
    {
        $this->backgroundwidth = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="backgroundheight", type="integer", nullable=false)
     */
    private $backgroundheight;

    public function getBackgroundheight()
    {
        return $this->backgroundheight;
    }
    public function setBackgroundHeight($value)
    {
        $this->backgroundheight = $value;
    }


}
