<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Picture {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /** @ORM\Column(type="string") */
		 protected $caption;

		 /** @ORM\Column(type="string") */
		 protected $credit;

		 /** @ORM\Column(type="blob") */
		 protected $picture;

		 /** @ORM\Column(type="integer") */
		 protected $width;

		 /** @ORM\Column(type="integer") */
		 protected $height;
		 
		 // getters/setters
}
