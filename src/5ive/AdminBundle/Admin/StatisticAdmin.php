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
            ->add('value', null, array(
                'label'    => 'Valeur'
            ))
            ->add('card', null, array(
                'label'    => 'Carton'
            ))
            ->add('cardValue', null, array(
                'label'    => 'Valeur du carton'
            ));

    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Nom de la statistique'))
            ->add('value', null, array('label' => 'Valeur'))
            ->add('card', null, array('label' => 'Carton'))
            ->add('cardValue', null, array('label' => 'Nombre de carton'));
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