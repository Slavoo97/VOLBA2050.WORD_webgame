<?php
/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Model\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Services\AnswerRepository")
 * @ORM\Table(name="`answer`")
 * @ORM\HasLifecycleCallbacks
 */
class Answer
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
     * @ORM\ManyToOne(targetEntity="Session")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @var Session
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @var Question
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="AnswerQuestion")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @var AnswerQuestion
     */
    private $answerQuestion;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param Session $session
     * @return Answer
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     * @return Answer
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return AnswerQuestion
     */
    public function getAnswerQuestion()
    {
        return $this->answerQuestion;
    }

    /**
     * @param AnswerQuestion $answerQuestion
     * @return Answer
     */
    public function setAnswerQuestion(AnswerQuestion $answerQuestion)
    {
        $this->answerQuestion = $answerQuestion;
        return $this;
    }


}
