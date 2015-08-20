<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Block
 *
 * @ORM\Table(name="Block")
 * @ORM\Entity
 */
class Block
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
     * @var \stdClass
     *
     * @ORM\Column(name="containerReference", type="object", nullable=false)
     */
    private $containerreference;

    public function getContainerreference()
    {
       return $this->containerreference;
    }
    public function setContainerreference($value)
    {
       $this->containerreference = $value
    }


}
