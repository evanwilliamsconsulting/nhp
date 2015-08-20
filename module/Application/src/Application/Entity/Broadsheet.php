<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Broadsheet
 *
 * @ORM\Table(name="Broadsheet")
 * @ORM\Entity
 */
class Broadsheet
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
     * @var integer
     *
     * @ORM\Column(name="pageNo", type="integer", nullable=false)
     */
    private $pageno;

    public function getPageno()
    {
	return $this->pageno;
    }
    public function setPageno($value)
    {
        $this->pageno = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="pageWidth", type="integer", nullable=false)
     */
    private $pagewidth;

    public function getPagewidth()
    {
        return $this->pagewidth;
    }
    public function setPagewidth($value)
    {
        $this->pagewidth = $value;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="pageHeight", type="integer", nullable=false)
     */
    private $pageheight;

    public function getPageheight()
    {
        return $this->pageheight;
    }
    public function setPageheight($value)
    {
	$this->pageheight = $value;        
    }
}
