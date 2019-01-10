<?php

namespace Application\Sonata\MediaBundle\Provider;
use Sonata\AdminBundle\Form\FormMapper;
use Gaufrette\Filesystem;
use Imagine\Image\ImagineInterface;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Form;
use Sonata\MediaBundle\Provider\FileProvider as BaseProvider;

class FileProvider extends BaseProvider
{

    /**
     *
     * @param FormMapper $formMapper
     */
    public function buildCreateForm(FormMapper $formMapper)
    {
        parent::buildCreateForm($formMapper);
    }

    /**
     *
     * @param FormMapper $formMapper
     */
    public function buildEditForm(FormMapper $formMapper)
    {
        parent::buildCreateForm($formMapper);
        $formMapper->add('duration', null, array(
          'label' => 'Document Duration'
        ));
    }

    /**
     *
     * @param MediaInterface $media
     */
    public function generatePath(MediaInterface $media)
    {
        $firstLevel  = explode('.', $media->getProviderName());
        $secondLevel = explode('.', $media->getProviderReference())[0];

        return sprintf('%s/%s/%s', $media->getContext(), end($firstLevel), $secondLevel);
    }
}
