<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Issue
 *
 * @ORM\Table(name="Issue")
 * @ORM\Entity
 */
class Issue
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfPublication", type="datetime", nullable=false)
     */
    private $dateofpublication;

    public function getDateofpublication()
    {
        return $this->dateofpublication;
    }
    public function setDateofpublication($value)
    {
        $this->dateofpublication = $value;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="toggleDivTagsOn", type="boolean", nullable=false)
     */
    private $toggledivtagson;

    public function getToggledivtagson()
    {
        return $this->toggledivtagson;
    }
    public function setToggledivtagson($value)
    {
        $this->toggledivtagson = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="priceOfCopy", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $priceofcopy;

    public function getPriceofcopy()
    {
        return $this->priceofcopy;
    }
    public function setPriceofcopy($value)
    {
        $this->priceofcopy = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="tagLine", type="string", length=255, nullable=false)
     */
    private $tagline;

    public function getTagline()
    {
        return $this->tagline;
    }
    public function setTagline($value)
    {
        $this->tagline = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="QRImage", type="blob", nullable=false)
     */
    private $qrimage;

    public function getQrimage()
    {
        return $this->qrimage;
    }
    public function setQrimage($value)
    {
        $this->qrimage=$value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="headingTheme", type="string", length=255, nullable=false)
     */
    private $headingtheme;

    public function getHeadingtheme()
    {
        return $this-headingtheme;
    }
    public function setHeadingtheme($value)
    {
        $this->headingtheme = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="secondTheme", type="string", length=255, nullable=false)
     */
    private $secondtheme;

    public function getSecondtheme()
    {
         return $this->secondtheme;
    }
    public function setSecondtheme($value)
    {
         $this->secondtheme=$value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="brace", type="string", length=255, nullable=false)
     */
    private $brace;

    public function getBrace()
    {
         return $this->brace;
    }
    public function setBrace($value)
    {
        $this->brace = $value;
    }


}
