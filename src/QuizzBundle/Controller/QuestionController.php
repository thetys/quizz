<?php
/**
 * Created by PhpStorm.
 * User: thetys
 * Date: 28/06/17
 * Time: 21:48
 */

namespace QuizzBundle\Controller;


use Doctrine\Common\Collections\Criteria;
use QuizzBundle\Service\QuestionService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    /**
     * @Route("/questions/{id}", name="question_get", requirements={"id": "\d+"})
     * @Method({"GET", "HEAD"})
     * @param $id
     * @param QuestionService $questionService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function onGetAction($id, QuestionService $questionService)
    {
        $question = $questionService->get($id);
        $answers = $question->getAnswers()->matching(
            Criteria::create()->orderBy(array('label' => Criteria::ASC))
        );
        return $this->render(
            '@Quizz/question/get.html.twig',
            array("question" => $question, "answers" => $answers)
        );
    }

    /**
     * @Route("/questions/{id}", name="question_post", requirements={"id": "\d+"})
     * @Method({"POST"})
     * @param $id
     * @param Request $request
     * @param QuestionService $questionService
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \HttpInvalidParamException* @internal param $answerId
     */
    public function onPostAction($id, Request $request, QuestionService $questionService)
    {
        $answerId = $request->get("answerId");
        if ($answerId === null) {
            throw new \HttpInvalidParamException("Aucune réponse fournie", 400);
        }
        $question = $questionService->get($id);
        $nextQuestionLink = null;
        if ($questionService->hasNext($question)) {
            $nextQuestionLink = $this->generateUrl(
                'question_get',
                array(
                    'id' => $questionService->getNext($question)->getId()
                ));
        }
        return $this->render(
            '@Quizz/question/answer.html.twig',
            array(
                "question" => $question,
                "correct" => ($question->getCorrectAnswer()->getId() == $answerId),
                "nextQuestionLink" => $nextQuestionLink
            )
        );
    }
}