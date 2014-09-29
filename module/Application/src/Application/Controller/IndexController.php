<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\ContactForm;
use Application\Model\ContactModel;

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

    private function setEntityData(array $data, $entity)
    {
        foreach ($data as $propertyName => $value) {
            $setterMethod = "set" . ucfirst($propertyName);
            $entity->$setterMethod($value);
        }
    }

    public function indexAction()
    {
        $em = $this->getEm();
        $contacts = $em->createQueryBuilder()
                       ->select('c')
                       ->from('Application\Entity\Contact', 'c')
                       ->getQuery()
                       ->getResult();

        return new ViewModel(array('records' => $contacts));
    }

    public function addAction()
    {
        $form = new ContactForm();

        if ($this->getRequest()->isPost()) {
            $model = new ContactModel();
            $data = $this->params()->fromPost();
            $form->setInputFilter($model->getInputFilter());
            $form->setData($data);

            if ($form->isValid()) {
                $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
                $em = $this->getEm();
                $entity = new \Application\Entity\Contact();
                $hydrator->hydrate($data, $entity);
                $em->persist($entity);
                $em->flush();

                $this->flashMessenger()->addInfoMessage('Registro cadastrado com sucesso.');
                $this->redirect()->toRoute('application', array('action' => 'index'));
            }
        }

        return new ViewModel(array('form' => $form));
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
            $this->setEntityData($data, $entity);
            $em->persist($entity);
            $em->flush();

            $this->flashMessenger()->addInfoMessage('Registro atualizado com sucesso.');
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

        $this->flashMessenger()->addInfoMessage('Registro apagado com sucesso.');
        $this->redirect()->toRoute('application', array('action' => 'index'));
    }
}
