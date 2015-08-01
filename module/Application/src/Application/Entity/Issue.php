<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Issue {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /** @ORM\Column(type="datetime") */
		 protected $dateOfPublication;
		 
		 /** @ORM\Column(type="boolean") */
		 protected $toggleDivTagsOn;

		 /** @ORM\Column(type="decimal") */
		 protected $priceOfCopy;

		 /** @ORM\Column(type="string") */
		 protected $tagLine;

		 /** @ORM\Column(type="blob") */
		 protected $QRImage;

		 /** @ORM\Column(type="string") */
		 protected $headingTheme;

		 /** @ORM\Column(type="string") */
		 protected $secondTheme;

		 /** @ORM\Column(type="string") */
		 protected $brace;

		 // getters/setters
}
