<?php

namespace  AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

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
            ->add('username', null, array(
                'label'    => 'Pseudo'
            ))
            ->add('email', null, array(
                'label'    => 'Email'
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('birth', DateType::class, array(
                'label'    => 'Date de naissance',
                'widget'   => 'single_text'
            ))
            ->add('userCity', null, array(
                'label'    => 'Ville du joueur'
            ))
            ->add('bio', null, array(
                'label'    => 'Biographie'
            ))
            ->add('level', null, array(
                'label'    => 'Niveau'
            ))
            ->add('points', null, array(
                'label'    => 'Points'
            ))
            ->add('regularityPlayer', null, array(
                'label'    => 'Régularité du joueur'
            ))
            ->add('rank', null, array(
                'label'    => 'Rang du joueur'
            ));
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('picture', null, array(
                'label'   => 'Avatar',
            ))
            ->add('username', null, array('label' => 'Pseudo'))
            ->add('email', null, array('label' => 'Email'))
            ->add('birth', null, array('label' => 'Date de naissance'))
            ->add('userCity', null, array('label' => 'Ville du joueur'))
            ->add('bio', null, array('label' => 'Biographie'))
            ->add('level', null, array('label' => 'Niveau'))
            ->add('points', null, array('label' => 'Points'))
            ->add('rank', null, array('label' => 'Rang du joueur'))
            ->add('regularityPlayer', null, array('label' => 'Régularité du joueur'));
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
//                    'show' => []
                )
            ));
    }
}