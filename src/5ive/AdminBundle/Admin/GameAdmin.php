<?php

namespace  AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class GameAdmin extends AbstractAdmin {

    protected $baseRouteName = 'admin_games';

    protected $baseRoutePattern = 'games';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array(
                'label'    => 'Nom de la partie'
            ))
            ->add('town', null, array(
                'label'    => 'Ville'
            ))
            ->add('date', null, array(
                'label'    => 'Date'
            ));


    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Nom de la partie'))
            ->add('town', null, array('label' => 'Ville'))
            ->add('date', null, array('label' => 'Date'));
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Nom de la partie'))
            ->addIdentifier('town', null, array('label' => 'Ville'))
            ->addIdentifier('date', null, array('label' => 'Date'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => [],
                    'delete' => [],
                    'show' => []
                )
            ));
    }
}