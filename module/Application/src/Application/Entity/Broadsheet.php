<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Broadsheet {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /** @ORM\Column(type="integer") */
		 protected $pageNo;
		 
		 /** @ORM\Column(type="integer") */
		 protected $pageWidth;
		 
		 /** @ORM\Column(type="integer") */
		 protected $pageHeight;
		 
		 // getters/setters
}
