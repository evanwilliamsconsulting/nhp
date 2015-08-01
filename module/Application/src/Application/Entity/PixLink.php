<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class PixLink {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;

		 /*
		  * Element
		  */

		 /** @ORM\Column(type="integer") */
		 protected $width;

		 /** @ORM\Column(type="integer") */
		 protected $height;

		 /** @ORM\Column(type="boolean") */
		 protected $gluex;

		 /** @ORM\Column(type="boolean") */
		 protected $gluey;

		 /** @ORM\Column(type="boolean") */
		 protected $prevx;

		 /** @ORM\Column(type="boolean") */
		 protected $prevy;

		 /** @ORM\Column(type="boolean") */
		 protected $resetx;

		 /** @ORM\Column(type="boolean") */
		 protected $resety;

		 /** @ORM\Column(type="boolean") */
		 protected $drift;

		 /** @ORM\Column(type="boolean") */
		 protected $gravity;

		 /** @ORM\Column(type="integer") */
		 protected $offsetx;

		 /** @ORM\Column(type="integer") */
		 protected $offsety;


		 /* Pix Link */
		 
		 /** @ORM\Column(type="string") */
		 protected $pixclass;

		 /** @ORM\Column(type="object") */
		 protected $pixReference;
		 
		 // getters/setters
}
