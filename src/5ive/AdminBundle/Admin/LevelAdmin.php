<?php

namespace  AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class LevelAdmin extends AbstractAdmin {

    protected $baseRouteName = 'admin_level';

    protected $baseRoutePattern = 'level';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('label', null, array(
                'label'    => 'Niveau'
            ));
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Niveau'));
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Niveau'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => [],
                    'delete' => [],
                    'show' => []
                )
            ));
    }
}