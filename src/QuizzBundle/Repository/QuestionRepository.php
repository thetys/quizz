<?php

namespace QuizzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use QuizzBundle\Entity\Question;

/**
 * QuestionRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends EntityRepository
{
    /**
     * @return null|Question
     */
    public function findFirstOrderedByPosition()
    {
        return $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('q')
            ->from('QuizzBundle:Question', 'q')
            ->orderBy('q.position', 'asc')
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleResult();
    }

    public function findNextOrderedByPosition($position)
    {
        return $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('q')
            ->from('QuizzBundle:Question', 'q')
            ->where('q.position > :position')
            ->orderBy('q.position', 'asc')
            ->setParameter('position', $position)
            ->getQuery()
            ->setMaxResults(1)
            ->getSingleResult();
    }

    public function countNextPositions($position)
    {
        return $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('COUNT(q)')
            ->from('QuizzBundle:Question', 'q')
            ->where('q.position > :position')
            ->setParameter('position', $position)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
