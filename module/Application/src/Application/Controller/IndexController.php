<?php
namespace Application\Controller;

use Application\Form\Contact as ContactForm;
use Application\Filter\Contact as ContactFilter;
use Application\Entity\Contact as ContactEntity;

class IndexController extends CrudController
{

    /**
     * Entidade do CRUD.
     * @return \Application\Entity\Contact
     */
    protected function getEntity()
    {
        if ($this->entity === null) {
            $this->entity = new ContactEntity();
        }
        return $this->entity;
    }

    /**
     * Formulário do CRUD.
     * @return \Application\Form\Contact
     */
    protected function getForm()
    {
        if ($this->form === null) {
            $this->form = new ContactForm();
        }
        return $this->form;
    }

    /**
     * Filtro para o formulário do CRUD.
     * @return \Application\Filter\Contact
     */
    protected function getFilter()
    {
        if ($this->filter === null) {
            $this->filter = new ContactFilter();
        }
        return $this->filter;
    }
}
