<?php
/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Services\QuestionRepository")
 * @ORM\Table(name="`question`")
 * @ORM\HasLifecycleCallbacks
 */
class Question
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
     *
     * @ORM\Column(type="string", nullable = false)
     * @var string
     */
    private $year;

    /**
     *
     * @ORM\Column(type="string", nullable = false)
     * @var string
     */
    private $questionName;

    /**
     *
     * @ORM\Column(type="text", nullable = false)
     * @var text
     */
    private $questionText;

    /**
     *
     * @ORM\Column(type="integer", nullable = false)
     * @var int
     */
    private $number;

    /**
     *
     * @ORM\Column(type="string", nullable = false)
     * @var string
     */
    private $url;

    /**
     *
     * @ORM\Column(type="string", nullable = false)
     * @var string
     */
    private $imgurl;

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
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getQuestionName(): string
    {
        return $this->questionName;
    }

    /**
     * @param string $questionName
     */
    public function setQuestionName(string $questionName): void
    {
        $this->questionName = $questionName;
    }

    /**
     * @return
     */
    public function getQuestionText()
    {
        return $this->questionText;
    }

    /**
     * @param $questionText
     */
    public function setQuestionText($questionText)
    {
        $this->questionText = $questionText;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getImgurl(): string
    {
        return $this->imgurl;
    }

    /**
     * @param string $imgurl
     * @return Question
     */
    public function setImgurl(string $imgurl): Question
    {
        $this->imgurl = $imgurl;
        return $this;
    }

}
