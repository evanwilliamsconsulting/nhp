<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Pixlink
 *
 * @ORM\Table(name="PixLink")
 * @ORM\Entity
 */
class Pixlink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** ELEMENT START **/
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
    public function setWidth($width)
    {
        $this->width = $width;
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
    public function setHeight($height)
    {
        $this->height=$height;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="gluex", type="boolean", nullable=false)
     */
    private $gluex;

    public function getGluex()
    {
        return $this->gluex;
    }
    public function setGluex($gluex)
    {
        $this->gluex = $gluex;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="gluey", type="boolean", nullable=false)
     */
    private $gluey;

    public function getGluey()
    {
        return $this->gluey;
    }
    public function setGluey($gluey)
    {
        $this->gluey = $gluey;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="prevx", type="boolean", nullable=false)
     */
    private $prevx;

    public function getPrevx()
    {
        return $this->prevx;
    }
    public function setPrevx($prevx)
    {
        $this->prevx = $prevx;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="prevy", type="boolean", nullable=false)
     */
    private $prevy;

    public function getPrevy()
    {
        return $this->prevy;
    }
    public function setPrevy($value)
    {
        $this->prevy=$value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="resetx", type="boolean", nullable=false)
     */
    private $resetx;

    public function getResetx()
    {
        return $this->resetx;
    }
    public function setResetx($value)
    {
        $this->resetx = $value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="resety", type="boolean", nullable=false)
     */
    private $resety;

    public function getResety()
    {
        return $this-resety;
    }
    public function setResety($value)
    {
        $this->resety=$value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="drift", type="boolean", nullable=false)
     */
    private $drift;

    public function getDrift()
    {
        return $this->drift;
    }
    public function setDrift($value)
    {
        $this->drift = $value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="gravity", type="boolean", nullable=false)
     */
    private $gravity;

    public function getGravity()
    {
        return $this->gravity;
    }
    public function setGravity($value)
    {
        $this->gravity = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="offsetx", type="integer", nullable=false)
     */
    private $offsetx;

    public function getOffsetx()
    {
        return $this->offsetx;
    }
    public function setOffsetx($value)
    {
        $this->offsetx = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="offsety", type="integer", nullable=false)
     */
    private $offsety;

    public function getOffsety()
    {
        return $this->offsety;
    }
    public function setOffsety($value)
    {
        $this->offsety = $value;
    }
    /** ELEMENT END **/

    /**
     * @var string
     *
     * @ORM\Column(name="pixclass", type="string", length=255, nullable=false)
     */
    private $pixclass;

    public function getPixclass()
    {
        return $this->pixclass;
    }
   
    public function setPixclass($value)
    {
        $this->pixclass = $value;
    }

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="pixReference", type="object", nullable=false)
     */
    private $pixreference;

    public function getPixreference()
    {
        return $this->pixreference;
    }
    public function setPixreference($value)
    {
       $this->pixreference = $value;
    }

}
