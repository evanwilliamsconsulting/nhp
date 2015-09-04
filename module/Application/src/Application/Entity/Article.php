<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 */
class Article
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $columnsize;

    /**
     * @var string
     */
    private $verbage;


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
     * Set columnsize
     *
     * @param integer $columnsize
     * @return Article
     */
    public function setColumnsize($columnsize)
    {
        $this->columnsize = $columnsize;

        return $this;
    }

    /**
     * Get columnsize
     *
     * @return integer 
     */
    public function getColumnsize()
    {
        return $this->columnsize;
    }

    /**
     * Set verbage
     *
     * @param string $verbage
     * @return Article
     */
    public function setVerbage($verbage)
    {
        $this->verbage = $verbage;

        return $this;
    }

    /**
     * Get verbage
     *
     * @return string 
     */
    public function getVerbage()
    {
        return $this->verbage;
    }
}
