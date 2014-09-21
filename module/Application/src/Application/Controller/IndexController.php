<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEm()
    {
        if ($this->em === null) {
            $this->em = $this->getServiceLocator()
                             ->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;
    }

    public function indexAction()
    {
        $em = $this->getEm();
        $contacts = $em->createQueryBuilder()
                       ->select('c')
                       ->from('Application\Entity\Contact', 'c')
                       ->getQuery()
                       ->getResult();

        return new ViewModel(array(
            'records' => $contacts,
        ));
    }

    /**
     * @TODO Implementar corretamente.
     */
    public function addAction()
    {
        $em = $this->getEm();

        $contact = new \Application\Entity\Contact();
        $contact->setName('Igor Cemim');
        $contact->setEmail('igor@cemim.com.br');
        $contact->setPhone('(51) 1234.5678');

        $em->persist($contact);
        $em->flush();
        
        return null;
    }

}
