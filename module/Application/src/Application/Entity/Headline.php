<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Headline {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /*
		  * Inherited from Element
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

		 /* Headline */
		 /** @ORM\Column(type="string") */
		 protected $headline;

		 /** @ORM\Column(type="string") */
		 protected $topline;

		 /** @ORM\Column(type="boolean") */
		 protected $usetopline;

		 /** @ORM\Column(type="integer") */
		 protected $fontsize;

		 /** @ORM\Column(type="string") */
		 protected $headlineclass;

		 /** @ORM\Column(type="boolean") */
		 protected $italic;
		 
		 // getters/setters
}
