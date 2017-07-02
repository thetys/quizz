<?php
/**
 * Created by PhpStorm.
 * User: thetys
 * Date: 29/06/17
 * Time: 21:58
 */

namespace QuizzBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PlayerAdmin extends AbstractAdmin
{
    protected $translationDomain = 'QuizzAdminBundle';

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name');
    }
}