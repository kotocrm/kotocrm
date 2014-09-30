<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

abstract class CrudController extends AbstractActionController
{

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    protected $entity;

    protected $form;

    protected $filter;

    /**
     * @return object
     */
    abstract protected function getEntity();

    /**
     * @return \Zend\Form\Form
     */
    abstract protected function getForm();

    /**
     * @return \Zend\InputFilter\InputFilterAwareInterface
     */
    abstract protected function getFilter();

    /**
     *
     * @return string
     */
    protected function getEntityClass()
    {
        return get_class($this->getEntity());
    }

    /**
     *
     * @param integer $id
     * @return object
     */
    protected function getEntityById($id)
    {
        return $this->getEm()->find($this->getEntityClass(), $id);
    }

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

    /**
     * Listagem
     * @return \Zend\View\Model\ViewModel
     */
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

    /**
     * Salva uma nova entidade.
     * @param array $data
     */
    protected function save(array $data)
    {
        $em = $this->getEm();
        $hydrator = new ClassMethodsHydrator();
        $entity = $this->getEntity();
        $hydrator->hydrate($data, $entity);
        $em->persist($entity);
        $em->flush();
    }

    /**
     * Prepara o formulário para utilização.
     * @param \Zend\Form\Form $form
     * @param array $data
     */
    protected function prepareForm($form, $data)
    {
        $filter = $this->getFilter();
        $form->setInputFilter($filter->getInputFilter());
        $form->setData($data);
    }

    /**
     * Processamento do formulário de cadastro.
     * @param \Zend\Form\Form $form
     * @param array $data
     */
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

    /**
     * Cadastrar
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $form = $this->getForm();

        if ($this->getRequest()->isPost()) {
            $postData = $this->params()->fromPost();
            $this->prepareForm($form, $postData);
            $this->processAdd($form, $postData);
        }

        $view = new ViewModel(array('form' => $form));
        return $view->setTemplate('application/index/form');
    }

    /**
     * Atualiza uma entidade.
     * @param array $data
     * @param object $entity
     */
    protected function update(array $data, $entity)
    {
        $em = $this->getEm();
        $hydrator = new ClassMethodsHydrator();
        $hydrator->hydrate($data, $entity);
        $em->persist($entity);
        $em->flush();
    }

    /**
     * Processamento do formulário de edição.
     * @param \Zend\Form\Form $form
     * @param array $data
     * @param object $entity
     */
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

    /**
     * Editar
     * @return \Zend\View\Model\ViewModel
     * @throws \BadMethodCallException
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (! $id) {
            throw new \BadMethodCallException('O parâmetro id é inválido ou não foi informado.');
        }

        $form = $this->getForm();
        $em = $this->getEm();
        $entity = $em->find($this->getEntityClass(), $id);
        $form->setHydrator(new ClassMethodsHydrator());
        $form->bind($entity);

        if ($this->getRequest()->isPost()) {
            $postData = $this->params()->fromPost();
            $this->prepareForm($form, $postData);
            $this->processEdit($form, $postData, $entity);
        }

        $view = new ViewModel(array('form' => $form));
        return $view->setTemplate('application/index/form');
    }

    /**
     * Apaga uma entidade.
     * @param string $class
     * @param integer $id
     */
    protected function delete($class, $id)
    {
        $em = $this->getEm();
        $entity = $em->find($class, $id);
        $em->remove($entity);
        $em->flush();
    }

    /**
     * Apagar
     * @throws \BadMethodCallException
     */
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
