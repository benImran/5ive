<?php

namespace Application\Sonata\MediaBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Admin\ORM\MediaAdmin as Admin;

class MediaAdmin extends Admin
{
    public function configureListFields(ListMapper $listMapper)
    {
      $listMapper
        ->addIdentifier('name')
        ->add('id');
    }

    public function configure() {
        $this->setTemplate('inner_list_row', '@SonataMedia/MediaAdmin/inner_row_media.html.twig');
        $this->setTemplate('outer_list_rows_mosaic', '@SonataMedia/MediaAdmin/list_outer_rows_mosaic.html.twig');
        $this->setTemplate('base_list_field', '@SonataAdmin/CRUD/base_list_flat_field.html.twig');
        $this->setTemplate('list', '@SonataMedia/MediaAdmin/list.html.twig');
        $this->setTemplate('edit', '@SonataMedia/MediaAdmin/edit.html.twig');
    }
}
