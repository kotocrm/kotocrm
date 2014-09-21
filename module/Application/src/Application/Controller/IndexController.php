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

    private function setData(array $data, $entity)
    {
        foreach ($data as $key => $value) {
            $set = "set" . ucfirst($key);
            $entity->$set($value);
        }

        return $entity;
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

    public function addAction()
    {
        $em = $this->getEm();
        $entity = new \Application\Entity\Contact();

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $entity = $this->setData($data, $entity);
            $em->persist($entity);
            $em->flush();

            $this->redirect()->toRoute('application', array('action' => 'index'));
        }

        return new ViewModel();
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            throw new \BadMethodCallException('O parâmetro id é inválido ou não foi informado.');
        }

        $em = $this->getEm();
        $entity = $em->find('Application\Entity\Contact', $id);

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $entity = $this->setData($data, $entity);
            $em->persist($entity);
            $em->flush();

            $this->redirect()->toRoute('application', array('action' => 'index'));
        }

        return new ViewModel(array('entity' => $entity));
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            throw new \BadMethodCallException('O parâmetro id é inválido ou não foi informado.');
        }

        $em = $this->getEm();
        $entity = $em->find('Application\Entity\Contact', $id);
        $em->remove($entity);
        $em->flush();
        
        $this->redirect()->toRoute('application', array('action' => 'index'));
    }

}
