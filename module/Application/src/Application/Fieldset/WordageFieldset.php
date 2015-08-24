<?php

class WordageFieldset extends Fieldset implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    function __construct($name = null)
    {
        parent::__construct('wordage_fieldset');

        $this->setHydrator(new ArraySerializableHydrator());
	$this->setObject(new Wordage());
    }
    public function init()
    {
        $this->add(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
	));
        $this->add(array(
                'name' => 'wordage',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
			    'max' => 5000,
	                ),
		   ),
		),
	));
        $this->add(array(
                'name' => 'columnSize',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
	));
    }
    public function setServiceLocator(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;
    }
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
} 
