<?php

namespace  AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{

    protected $baseRouteName = 'admin_user';

    protected $baseRoutePattern = 'user';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('picture', 'sonata_type_model_list', array(
                'label'   => 'Avatar',
            ), array(
                'link_parameters' => array(
                    'context' => 'default'
                )
            ))
            ->add('birth', null, array(
                'label'    => 'Date de naissance'
            ))
            ->add('bio', null, array(
                'label'    => 'Biographie'
            ))
            ->add('level', null, array(
                'label'    => 'Niveau'
            ))
            ->add('points', null, array(
                'label'    => 'Points'
            ));
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('picture', null, array(
                'label'   => 'Avatar',
            ))
            ->add('birth', null, array('label' => 'Date de naissance'))
            ->add('bio', null, array('label' => 'Biographie'))
            ->add('level', null, array('label' => 'Niveau'))
            ->add('points', null, array('label' => 'Points'));
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->addIdentifier('username', null, array('label' => 'Pseudo'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => [],
                    'delete' => [],
                    'show' => []
                )
            ));
    }
}