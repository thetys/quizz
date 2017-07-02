<?php
/**
 * Created by PhpStorm.
 * User: thetys
 * Date: 01/07/17
 * Time: 22:45
 */

namespace QuizzBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Player
 * @package QuizzBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="player")
 */
class Player
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
    private $name;

    /**
     * @return null|string
     */
    public function getName()
    {
        return (string) $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    function __toString()
    {
        return $this->getName();
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


}
