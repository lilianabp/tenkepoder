<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use App\Entity\ServiceTranslation;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Form\Type\ModelListType;

final class ServiceAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('abstract')
            ->add('description')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('abstract')
            ->add('description')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Datos del Servicio', ['class' => 'col-md-6'])
            ->add('name')
            ->add('abstract', CKEditorType::class, [])
            ->add('description', CKEditorType::class, [])
            ->end()
            ->with('Service Data', ['class' => 'col-md-6'])
            ->add('name_en')
            ->add('abstract_en', CKEditorType::class, [])
            ->add('description_en', CKEditorType::class, [])
            ->end()
            ->add('image', ModelListType::class)
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('abstract')
            ->add('description')
            ;
    }
}
