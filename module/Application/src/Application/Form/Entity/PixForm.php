<?php

namespace Application\Form\Entity;

use Zend\Form\Form;

class PixForm extends Form
{
    public function __construct($name = null)
    {
        parent:: __construct('headline');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));
        $this->add(array(
            'name' => 'caption',
            'type' => 'Text',
            'options' => array(
                'label' => 'Caption',
            ),
        ));
        $this->add(array(
            'name' => 'credit',
            'type' => 'Text',
            'options' => array(
                'label' => 'Credit',
            ),
        ));
        $this->add(array(
            'name' => 'picture',
            'type' => 'File',
            'options' => array(
                'label' => 'Picture',
            ),
        ));
        $this->add(array(
            'name' => 'width',
            'type' => 'Text',
            'options' => array(
                'label' => 'width',
            ),
        ));
        $this->add(array(
            'name' => 'height',
            'type' => 'Text',
            'options' => array(
                'label' => 'height',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Add',
                'id' => 'submitbutton',
            ),
        ));
    }
}
