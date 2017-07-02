<?php
/**
 * Created by PhpStorm.
 * User: thetys
 * Date: 02/07/17
 * Time: 11:47
 */

namespace QuizzBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use QuizzBundle\Entity\Question;

class QuestionService
{
    private $questionRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->questionRepository = $em->getRepository('QuizzBundle:Question');
    }

    /**
     * @return Question
     */
    public function getFirst(): Question
    {
        return $this->questionRepository->findFirstOrderedByPosition();
    }

    /**
     * @param Question $question
     * @return null|Question
     */
    public function getNext(Question $question)
    {
        return $this->questionRepository->findNextOrderedByPosition($question->getPosition());
    }

    /**
     * @param int $id
     * @return null|Question
     */
    public function get(int $id)
    {
        return $this->questionRepository->find($id);
    }

    public function hasNext(Question $question): bool
    {
        return $this->questionRepository->countNextPositions($question->getPosition()) > 0;
    }

}