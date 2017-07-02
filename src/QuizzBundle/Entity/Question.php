<?php
/**
 * Created by PhpStorm.
 * User: thetys
 * Date: 28/06/17
 * Time: 23:09
 */

namespace QuizzBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Question
 * @package QuizzBundle\Entity
 * @ORM\Entity(repositoryClass="QuizzBundle\Repository\QuestionRepository")
 * @ORM\Table(name="question")
 */
class Question
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $label;

    /**
     * @var ArrayCollection<Answer>
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question", orphanRemoval=true)
     */
    private $answers;

    /**
     * @var Answer
     * @ORM\OneToOne(targetEntity="Answer")
     * @Assert\Choice(callback="getAnswersArray")
     */
    private $correctAnswer;

    /**
     * @var int
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var Player
     * @ORM\ManyToOne(targetEntity="QuizzBundle\Entity\Player")
     */
    private $player;

    /**
     * Question constructor.
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection<Answer>
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param ArrayCollection $answers
     * @internal param $ArrayCollection <Answer> $answers
     */
    public function setAnswers(ArrayCollection $answers)
    {
        $this->answers = $answers;
    }

    /**
     * @return null|Answer
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }

    /**
     * @param Answer $correctAnswer
     */
    public function setCorrectAnswer(Answer $correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return (string)$this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    function __toString()
    {
        return $this->getLabel();
    }

    /**
     * @return array
     */
    public function getAnswersArray(): array
    {
        return $this->getAnswers()->toArray();
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
    }

    /**
     * @return null|Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Add answer
     *
     * @param Answer $answer
     *
     * @return Question
     */
    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param Answer $answer
     */
    public function removeAnswer(Answer $answer)
    {
        $this->answers->removeElement($answer);
    }
}
