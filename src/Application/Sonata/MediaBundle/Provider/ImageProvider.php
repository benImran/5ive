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
use Sonata\MediaBundle\Provider\ImageProvider as BaseProvider;

class ImageProvider extends BaseProvider
{

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
