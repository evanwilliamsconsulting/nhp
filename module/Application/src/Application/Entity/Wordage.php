<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Wordage {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /** @ORM\Column(type="string") */
		 protected $wordage;

		 /** @ORM\Column(type="integer") */
		 protected $columnSize;

		 // getters/setters
}
