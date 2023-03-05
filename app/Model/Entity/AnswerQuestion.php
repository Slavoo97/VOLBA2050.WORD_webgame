<?php
/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Model\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Services\AnswerQuestionRepository")
 * @ORM\Table(name="`answer_question`")
 * @ORM\HasLifecycleCallbacks
 */
class AnswerQuestion
{

    /**
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @var Question
     */
    private $question;

    /**
     *
     * @ORM\Column(type="text", nullable = false)
     *
     */
    private $answerText;

    /**
     *
     * @ORM\Column(type="integer", nullable = false)
     * @var integer
     */
    private $points;

    /**
     *
     * @ORM\Column(type="string", nullable = false)
     * @var string
     */
    private $marker;

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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Question
     */
    public function getQuestion(): Question
    {
        return $this->question;
    }

    /**
     * @param Question $question
     */
    public function setQuestion(Question $question): void
    {
        $this->question = $question;
    }

    /**
     * @return text
     */
    public function getAnswerText()
    {
        return $this->answerText;
    }

    /**
     * @param text $answerText
     */
    public function setAnswerText($answerText): void
    {
        $this->answerText = $answerText;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getMarker(): string
    {
        return $this->marker;
    }

    /**
     * @param string $marker
     * @return AnswerQuestion
     */
    public function setMarker(string $marker): AnswerQuestion
    {
        $this->marker = $marker;
        return $this;
    }

}
