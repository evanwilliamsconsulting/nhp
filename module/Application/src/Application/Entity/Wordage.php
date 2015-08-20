<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Wordage
 *
 * @ORM\Table(name="Wordage")
 * @ORM\Entity
 */
class Wordage
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
     * @ORM\Column(name="wordage", type="string", length=255, nullable=false)
     */
    private $wordage;

    public getWordage()
    {
        return $this->wordage;
    }
    public function setWordage($value)
    {
	$this->wordage = $value;
    }

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


}
