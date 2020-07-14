<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use App\Entity\ServiceTranslation;

final class ServiceAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('abstract')
            ->add('wp1_title')
            ->add('wp1_desc')
            ->add('wp2_title')
            ->add('wp2_desc')
            ->add('wp3_title')
            ->add('wp3_desc')
            ->add('description')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('abstract')
            ->add('wp1_title')
            ->add('wp1_desc')
            ->add('wp2_title')
            ->add('wp2_desc')
            ->add('wp3_title')
            ->add('wp3_desc')
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
            ->add('id')
            ->add('name')
            ->add('abstract')
            ->add('wp1_title')
            ->add('wp1_desc')
            ->add('wp2_title')
            ->add('wp2_desc')
            ->add('wp3_title')
            ->add('wp3_desc')
            ->add('description')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('abstract')
            ->add('wp1_title')
            ->add('wp1_desc')
            ->add('wp2_title')
            ->add('wp2_desc')
            ->add('wp3_title')
            ->add('wp3_desc')
            ->add('description')
            ;
    }
}
