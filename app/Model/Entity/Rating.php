<?php
/**
 * This file is part of the 2050 project.
 * Copyright (c) 2023 Slavomír Švigar <slavo.svigar@gmail.com>
 */

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Services\RatingRepository")
 * @ORM\Table(name="`rating`")
 * @ORM\HasLifecycleCallbacks
 */
class Rating
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
    private $pointsFrom;

    /**
     *
     * @ORM\Column(type="string", nullable = false)
     * @var string
     */
    private $pointsTo;

    /**
     *
     * @ORM\Column(type="text", nullable = false)
     * @var text
     */
    private $ratingText;

    /**
     *
     * @ORM\Column(type="string", nullable = false)
     * @var string
     */
    private $ratingHeader;

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
    public function getPointsFrom(): string
    {
        return $this->pointsFrom;
    }

    /**
     * @param string $pointsFrom
     */
    public function setPointsFrom(string $pointsFrom): void
    {
        $this->pointsFrom = $pointsFrom;
    }

    /**
     * @return string
     */
    public function getPointsTo(): string
    {
        return $this->pointsTo;
    }

    /**
     * @param string $pointsTo
     */
    public function setPointsTo(string $pointsTo): void
    {
        $this->pointsTo = $pointsTo;
    }

    /**
     * @return text
     */
    public function getRatingText()
    {
        return $this->ratingText;
    }

    /**
     * @param $ratingText
     */
    public function setRatingText($ratingText): void
    {
        $this->ratingText = $ratingText;
    }

    /**
     * @return string
     */
    public function getRatingHeader(): string
    {
        return $this->ratingHeader;
    }

    /**
     * @param string $ratingHeader
     */
    public function setRatingHeader(string $ratingHeader): void
    {
        $this->ratingHeader = $ratingHeader;
    }

}
