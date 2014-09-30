<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

abstract class CrudController extends AbstractActionController
{

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    abstract protected function getEntityClass();

    abstract protected function getEntity();

    abstract protected function getEntityById($id);

    abstract protected function getForm();

    abstract protected function getFilter();

    /**
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEm()
    {
        if ($this->em === null) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;
    }

    public function indexAction()
    {
        $em = $this->getEm();
        $contacts = $em->createQueryBuilder()
            ->select('c')
            ->from($this->getEntityClass(), 'c')
            ->getQuery()
            ->getResult();

        return new ViewModel(array(
            'records' => $contacts,
        ));
    }

    protected function save(array $data)
    {
        $em = $this->getEm();
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $entity = $this->getEntity();
        $hydrator->hydrate($data, $entity);
        $em->persist($entity);
        $em->flush();
    }

    protected function prepareForm($form, $data)
    {
        $filter = $this->getFilter();
        $form->setInputFilter($filter->getInputFilter());
        $form->setData($data);
    }

    protected function processAdd($form, $data)
    {
        if ($form->isValid()) {
            $this->save($data);
            $this->flashMessenger()->addInfoMessage('Registro cadastrado com sucesso.');
            $this->redirect()->toRoute('application', array(
                'action' => 'index'
            ));
        }
    }

    public function addAction()
    {
        $form = $this->getForm();

        if ($this->getRequest()->isPost()) {
            $postData = $this->params()->fromPost();
            $this->prepareForm($form, $postData);
            $this->processAdd($form, $postData);
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }

    protected function update(array $data, $entity)
    {
        $em = $this->getEm();
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $hydrator->hydrate($data, $entity);
        $em->persist($entity);
        $em->flush();
    }

    protected function processEdit($form, $data, $entity)
    {
        if ($form->isValid()) {
            $this->update($data, $entity);
            $this->flashMessenger()->addInfoMessage('Registro atualizado com sucesso.');
            $this->redirect()->toRoute('application', array(
                'action' => 'index'
            ));
        }
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (! $id) {
            throw new \BadMethodCallException('O parâmetro id é inválido ou não foi informado.');
        }

        $form = $this->getForm();
        $em = $this->getEm();
        $entity = $em->find($this->getEntityClass(), $id);

        if ($this->getRequest()->isPost()) {
            $postData = $this->params()->fromPost();
            $this->prepareForm($form, $postData);
            $this->processEdit($form, $postData, $entity);
        }

        return new ViewModel(array(
            'entity' => $entity
        ));
    }

    protected function delete($class, $id)
    {
        $em = $this->getEm();
        $entity = $em->find($class, $id);
        $em->remove($entity);
        $em->flush();
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (! $id) {
            throw new \BadMethodCallException('O parâmetro id é inválido ou não foi informado.');
        }

        $this->delete($this->getEntityClass(), $id);
        $this->flashMessenger()->addInfoMessage('Registro apagado com sucesso.');
        $this->redirect()->toRoute('application', array(
            'action' => 'index'
        ));
    }
}
