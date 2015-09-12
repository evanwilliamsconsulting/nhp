<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="Container")
 */
class Container 
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $background;

    /**
     * @var boolean
     */
    private $frame;

    /**
     * @var integer
     */
    private $backgroundwidth;

    /**
     * @var integer
     */
    private $backgroundheight;


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
     * Set background
     *
     * @param string $background
     * @return Container
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string 
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set frame
     *
     * @param boolean $frame
     * @return Container
     */
    public function setFrame($frame)
    {
        $this->frame = $frame;

        return $this;
    }

    /**
     * Get frame
     *
     * @return boolean 
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * Set backgroundwidth
     *
     * @param integer $backgroundwidth
     * @return Container
     */
    public function setBackgroundwidth($backgroundwidth)
    {
        $this->backgroundwidth = $backgroundwidth;

        return $this;
    }

    /**
     * Get backgroundwidth
     *
     * @return integer 
     */
    public function getBackgroundwidth()
    {
        return $this->backgroundwidth;
    }

    /**
     * Set backgroundheight
     *
     * @param integer $backgroundheight
     * @return Container
     */
    public function setBackgroundheight($backgroundheight)
    {
        $this->backgroundheight = $backgroundheight;

        return $this;
    }

    /**
     * Get backgroundheight
     *
     * @return integer 
     */
    public function getBackgroundheight()
    {
        return $this->backgroundheight;
    }
}
