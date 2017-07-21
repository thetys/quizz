<?php

namespace QuizzBundle\Controller;

use Doctrine\ORM\NoResultException;
use QuizzBundle\Service\QuestionService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param QuestionService $questionService
     * @return Response
     */
    public function indexAction(QuestionService $questionService)
    {
        try {
            $first = $questionService->getFirst();
        } catch (NoResultException $e) {
            $first = null;
        }
        
        return $this
            ->render(
                '@Quizz/default/index.html.twig',
                array(
                    "firstQuestionId" => ($first ? $first->getId() : null)
                )
            );
    }
}
