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
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuestionAdmin extends AbstractAdmin
{
    protected $translationDomain = 'QuizzAdminBundle';

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'position'
    );

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('label')
            ->add('answers')
            ->add('correctAnswer', EntityType::class, array(
                'class' => 'QuizzBundle:Answer',
                'choices' => $this->getSubject()->getAnswers()
            ))
            ->add('player');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('label')
            ->add('answers')
            ->add('correctAnswer')
            ->add('player');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('label')
            ->add('answers')
            ->add('correctAnswer')
            ->add('player')
            ->add('_action', null, array(
                'actions' => array(
                    'move' => array(
                        'template' => 'PixSortableBehaviorBundle:Default:_sort.html.twig'
                    )
                )
            ));
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
        $collection->add('move', $this->getRouterIdParameter() . '/move/{position}');
    }
}