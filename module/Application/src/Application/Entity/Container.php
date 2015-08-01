<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Container {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /** @ORM\Column(type="blob") */
		 protected $background;
		 
		 /** @ORM\Column(type="boolean") */
		 protected $frame;
		 
		 /** @ORM\Column(type="integer") */
		 protected $backgroundwidth;
		 
		 /** @ORM\Column(type="integer") */
		 protected $backgroundheight;
		 
		 // getters/setters
}
