<?php

namespace QuizzBundle\Controller;

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
        $firstQuestionLink = $this->generateUrl(
            'question_get',
            array(
                'id' => $questionService->getFirst()->getId()
            ));
        return $this
            ->render(
                '@Quizz/default/index.html.twig',
                array(
                    "firstQuestionLink" => $firstQuestionLink
                )
            );
    }
}
