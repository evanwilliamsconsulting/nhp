<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Block {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 /** @ORM\Column(type="object") */
		 protected $containerReference;
		 
		 // getters/setters
}
