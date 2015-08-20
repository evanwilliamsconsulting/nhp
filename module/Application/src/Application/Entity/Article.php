<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="Article")
 * @ORM\Entity
 */
class Article
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
     * @ORM\Column(name="columnSize", type="integer", nullable=false)
     */
    private $columnsize;

    public function getColumnsize()
    {
        return $this->columnsize;
    }
    public function setColumnsize($value)
    {
        $this->columnsize = $value;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="verbage", type="string", length=255, nullable=false)
     */
    private $verbage;

    public function getVerbage()
    {
        return $this->verbage;
    }
    public function setVerbage($value)
    {
        $this->verbage = $value;
    }


}
