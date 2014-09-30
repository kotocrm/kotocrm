<?php
namespace Application\Controller;

use Application\Form\Contact as ContactForm;
use Application\Filter\Contact as ContactFilter;
use Application\Entity\Contact as ContactEntity;

class IndexController extends CrudController
{

    /**
     * 
     * @return string
     */
    public function getEntityClass()
    {
        return 'Application\Entity\Contact';
    }

    /**
     * 
     * @return \Application\Entity\Contact
     */
    protected function getEntity()
    {
        return new ContactEntity();
    }

    /**
     * 
     * @param integer $id
     * @return \Application\Entity\Contact
     */
    public function getEntityById($id)
    {
        return $this->getEm()->find('Application\Entity\Contact', $id);
    }

    /**
     * 
     * @return \Application\Form\Contact
     */
    protected function getForm()
    {
        return new ContactForm();
    }

    /**
     * 
     * @return \Application\Filter\Contact
     */
    protected function getFilter()
    {
        return new ContactFilter();
    }
}
