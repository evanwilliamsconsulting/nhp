<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Richcolumn
 *
 * @ORM\Table(name="RichColumn")
 * @ORM\Entity
 */
class Richcolumn
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
     * @var \stdClass
     *
     * @ORM\Column(name="article", type="object", nullable=false)
     */
    private $article;

    public getArticle()
    {
	return $this->article;
    }
    public setArticle($value)
    {
       $this->article = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="startLine", type="integer", nullable=false)
     */
    private $startline;
    public function getStartline()
    {
        return $this->startline;
    }
    public function setStartline($value)
    {
        $this->startline = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="endLine", type="integer", nullable=false)
     */
    private $endline;
    public function getEndLine()
    {
        return $this->endline;
    }
    public function setEndline($value)
    {
        $this->endline=$Value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="useRemainder", type="boolean", nullable=false)
     */
    private $useremainder;
    public function getUseremainder()
    {
        return $this->useremainder;
    }
    public function setUseremainder($value)
    {
        $this->useremainder = $value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="useContinuedOn", type="boolean", nullable=false)
     */
    private $usecontinuedon;
    public function setUsecontinuedon($value)
    {
        $this->usecontinuedon = $value;
    }
    public function getUsecontinuedon()
    {
        return $this->usecontinuedon;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="continuedOn", type="string", length=255, nullable=false)
     */
    private $continuedon;
    public function setContinuedOn($value)
    {
        $this->continuedon = $value;
    ]
    public function getContinuedOn()
    {
        return $value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="useContinuedFrom", type="boolean", nullable=false)
     */
    private $usecontinuedfrom;

    public function setUsecontinuedfrom($value)
    {
        $this->usecontinuedfrom = $value;
    }
    public function getUsecontinuedfrom()
    {
        return $this->usecontinuedfrom;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="continuedFrom", type="string", length=255, nullable=false)
     */
    private $continuedfrom;

    public function setContinuedFrom($value)
    {
        $this->continuedFrom = $value;
    }
    public function getContinuedFrom()
    {
        return $this->continuedFrom;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="charsPerLine", type="integer", nullable=false)
     */
    private $charsperline;

    public function getCharsperline()
    {
        return $this->charsperline;
    }
    public function setCharsperline($value);
    {
        $this->charsperline = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="textClass", type="string", length=255, nullable=false)
     */
    private $textclass;
 
    public function getTextclass()
    {
        return $this->textclass;
    }
    public function setTextclass($value)
    {
        $this->textclass = $value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="addLineHeight", type="boolean", nullable=false)
     */
    private $addlineheight;
   
    public function getAddlineheight()
    {
        return $this->addlineheight;
    }
    public function setAddlineheight($value)
    {
        $this->addlineheight = $value;
    }


}
