<?php

namespace  AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class LevelAdmin extends AbstractAdmin {

    protected $baseRouteName = 'admin_level';

    protected $baseRoutePattern = 'level';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('rank', null, array(
                'label'    => 'Rang du joueur'
            ))
            ->add('countMatch', null, array(
                'label'    => 'Palier'
            ))
            ->add('users', null,array(
                'label' => 'Joueur'
            ));;


    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('rank', null, array('label' => 'Rang du joueur'))
            ->add('countMatch', null, array('label' => 'Palier'))
            ->add('users', null, array('label' => 'Joueur'));

    }
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->addIdentifier('rank', null, array('label' => 'Rang du joueur'))
            ->addIdentifier('countMatch', null, array('label' => 'Palier'))
            ->addIdentifier('users', null, array('label' => 'Joueur'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => [],
                    'delete' => [],
//                    'show' => []
                )
            ));
    }

//    protected function configureShowFields(ShowMapper $showMapper)
//    {
//        $showMapper
//            ->add('users', null, [
//                'label' => 'Joueurs'
//            ])
//            ->add('users', null, [
//                'label' => 'Joueurs'
//            ]);
//    }
}