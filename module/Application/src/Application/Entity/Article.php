<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Article {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 /** @ORM\Column(type="integer") */
		 protected $columnSize;
		 /** @ORM\Column(type="string") */
		 protected $verbage;
		 
		 // getters/setters
}
