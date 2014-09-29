<?php

namespace Application\Form;

use Zend\Form\Form;

class ContactForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('contact');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nome',
            ),
        ));
        $this->add(array(
            'name' => 'state',
            'type' => 'Text',
            'options' => array(
                'label' => 'Estado',
            ),
        ));
        $this->add(array(
            'name' => 'district',
            'type' => 'Text',
            'options' => array(
                'label' => 'Bairro',
            ),
        ));
        $this->add(array(
            'name' => 'address',
            'type' => 'Text',
            'options' => array(
                'label' => 'Endereço',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => 'E-mail',
            ),
        ));
        $this->add(array(
            'name' => 'phone',
            'type' => 'Text',
            'options' => array(
                'label' => 'Telefone',
            ),
        ));
        $this->add(array(
            'name' => 'cpf',
            'type' => 'Text',
            'options' => array(
                'label' => 'CPF',
            ),
        ));
        $this->add(array(
            'name' => 'rg',
            'type' => 'Text',
            'options' => array(
                'label' => 'RG',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Enviar',
                'id' => 'submit-button',
            ),
        ));
    }
}
