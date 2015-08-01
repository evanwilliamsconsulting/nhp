<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class TextColumn {
		/**
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 * @ORM\Column(type="integer")
		 */
		 protected $id;
		 
		 /* Element */
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

		 /* TextColumn */
		 /** @ORM\Column(type="integer") */
		 protected $startLine;

		 /** @ORM\Column(type="integer") */
		 protected $endLine;

		 /** @ORM\Column(type="integer") */
		 protected $fontSize;

		 /** @ORM\Column(type="boolean") */
		 protected $useRemainder;

		 /** @ORM\Column(type="boolean") */
		 protected $useContinuedOn;

		 /** @ORM\Column(type="boolean") */
		 protected $useContinuedFrom;

		 /** @ORM\Column(type="string") */
		 protected $continuedOn;

		 /** @ORM\Column(type="string") */
		 protected $continuedFrom;

		 /** @ORM\Column(type="integer") */
		 protected $charsPerLine;

		 /** @ORM\Column(type="string") */
		 protected $textclass;

		 /** @ORM\Column(type="object") */
		 protected $wordage;


		 // getters/setters
}
