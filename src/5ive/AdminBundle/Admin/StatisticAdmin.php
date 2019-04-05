<?php

namespace  AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class StatisticAdmin extends AbstractAdmin {

    protected $baseRouteName = 'admin_statistic';

    protected $baseRoutePattern = 'statistic';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array(
                'label'    => 'Nom de la statistique'
            ))
            ->add('picto', null, array(
                'label'    => 'Picto'
            ))
            ->add('value', null, array(
                'label'    => 'Valeur'
            ));
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Nom de la statistique'))
            ->add('picto', null, array('label' => 'Picto'))
            ->add('value', null, array('label' => 'Valeur'));
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Nom de la partie'))
            ->addIdentifier('team', null, array('label' => 'Picto'))
            ->addIdentifier('town', null, array('label' => 'Valeur'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => [],
                    'delete' => [],
                    'show' => []
                )
            ));
    }
}