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
//
    protected $baseRouteName = 'admin_user';
//
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
            ));

        if  (!$this->getSubject()->getId()) {
            $formMapper->add('plainPassword', RepeatedType::class, array(
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
            ));
        }
        $formMapper->add('birth', DateType::class, array(
            'label'    => 'Date de naissance',
            'widget'   => 'single_text'
        ))
            ->add('userCity', null, array(
                'label'    => 'Ville du joueur'
            ))
            ->add('bio', null, array(
                'label'    => 'Biographie'
            ))
            ->add('regularityPlayers', null, array(
                'label'    => 'Régularité du joueur'
            ))
            ->add('game', 'sonata_type_model', array(
                'label'    => 'Matchs',
                'by_reference' => false,
                'multiple' => true,
                'btn_add' => false
            ))
            ->add('level', 'sonata_type_model_list',[
                'btn_add'       => 'Add level',
                'btn_list'      => true,      //which will be translated
                'btn_delete'    => false,              //or hide the button.
                'btn_edit'      => false,             //Hide add and show edit button when value is set
                'btn_catalogue' => false
            ], [
                'placeholder' => 'No author selected',
            ]);
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
            ->add('regularityPlayers', null, array('label' => 'Régularité du joueur'))
            ->add('game', null, array('label' => 'Matchs'))
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->addIdentifier('username', null, array('label' => 'Pseudo'))
            ->addIdentifier('picture', 'sonata_type_model_list', array(
                'label'   => 'Avatar',
            ), array(
                'link_parameters' => array(
                    'context' => 'default'
                )
            ))
            ->addIdentifier('email', null, array('label' => 'Email'))
            ->addIdentifier('birth', null, array('label' => 'Date de naissance'))
            ->addIdentifier('userCity', null, array('label' => 'Ville du joueur'))
            ->addIdentifier('bio', null, array('label' => 'Biographie'))
            ->addIdentifier('regularityPlayers', null, array('label' => 'Régularité du joueur'))
            ->addIdentifier('game', null, array('label' => 'Matchs'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => [],
                    'delete' => [],
                )
            ));
    }
}