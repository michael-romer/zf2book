<?php
namespace Helloworld\Form;

use Zend\Form\Fieldset;

class UserFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('user');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'name'
            ),
            'options' => array(
                'id' => 'name',
                'label' => 'Ihr Name:',
            )
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
            ),
            'options' => array(
                'id' => 'email',
                'label' => 'Ihre E-Mail-Adresse:'
            ),
        ));

        $this->add(array(
            'type' => 'Helloworld\Form\UserAddressFieldset',
            )
        );
    }
}