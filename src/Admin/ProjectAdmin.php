<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Form\Type\ModelListType;

final class ProjectAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('start_date')
            ->add('finish_date')
            ->add('web_url')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('start_date')
            ->add('finish_date')
            ->add('web_url')
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
        ->with('Datos del Proyecto', ['class' => 'col-md-6'])
            ->add('name')
            ->add('description', CKEditorType::class, [])
            ->end()
            ->with('Project Data', ['class' => 'col-md-6'])
            ->add('name_en')
            ->add('description_en', CKEditorType::class, [])
            ->end()
            ->add('client')
            ->add('category')
            ->add('start_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('finish_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('web_url')
            ->add('image', ModelListType::class)
            ->add('gallery', ModelListType::class)
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('start_date')
            ->add('finish_date')
            ->add('web_url')
            ;
    }
}
