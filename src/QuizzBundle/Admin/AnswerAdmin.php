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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AnswerAdmin extends AbstractAdmin
{
    protected $translationDomain = 'QuizzAdminBundle';

    protected function configureFormFields(FormMapper $form)
    {
        $form->add('label')
            ->add('question', EntityType::class, array(
                'required' => true,
                'class' => 'QuizzBundle:Question'
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('label')
            ->add('question');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('label')
            ->add('question');
    }
}