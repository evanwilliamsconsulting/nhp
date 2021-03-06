<?php
//  http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html

 namespace Application\Service;

 use Application\Entity\Experience;

 interface WordageServiceInterface
 {
     /**
      * Should return a set of all Wordage Items that we can iterate over. Single entries of the array are supposed to be
      * implementing \Application\Entity\Experience
      *
      * @return array|Wordage[]
      */
     public function findAllExperience();

     /**
      * Should return a single Wordage
      *
      * @param  int $id Identifier of the Wordage that should be returned
      * @return Wordage
      */
     public function findExperience($id);
 }
