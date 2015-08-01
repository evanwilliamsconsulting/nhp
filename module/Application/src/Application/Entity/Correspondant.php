<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Correspondant {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /** @ORM\Column(type="string") */
		 protected $username;
		 
		 /** @ORM\Column(type="string") */
		 protected $handle;
		 
		 /** @ORM\Column(type="string") */
		 protected $wordage;

		 /** @ORM\Column(type="blob") */
		 protected $picture;
		 
		 /** @ORM\Column(type="integer") */
		 protected $width;
		 
		 /** @ORM\Column(type="integer") */
		 protected $height;
		 
		 
		 // getters/setters
}
