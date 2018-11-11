<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LetterRepository")
 */
class Letter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $letter;

    /**
     * @ORM\Column(type="time")
     */
    private $timeRange;

    /**
     * @ORM\Column(type="time")
     */
    private $startHour;

    /**
     * @ORM\Column(type="time")
     */
    private $endHour;

    /**
     * @ORM\Column(type="time")
     */
    private $effectiveDuration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLetter(): ?string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): self
    {
        $this->letter = $letter;

        return $this;
    }

    public function getTimeRange(): ?\DateTimeInterface
    {
        return $this->timeRange;
    }

    public function setTimeRange(\DateTimeInterface $timeRange): self
    {
        $this->timeRange = $timeRange;

        return $this;
    }

    public function getStartHour(): ?\DateTimeInterface
    {
        return $this->startHour;
    }

    public function setStartHour(\DateTimeInterface $startHour): self
    {
        $this->startHour = $startHour;

        return $this;
    }

    public function getEndHour(): ?\DateTimeInterface
    {
        return $this->endHour;
    }

    public function setEndHour(\DateTimeInterface $endHour): self
    {
        $this->endHour = $endHour;

        return $this;
    }


    public function getEffectiveDuration(): ?\DateTimeInterface
    {
        return $this->effectiveDuration;
    }

    public function setEffectiveDuration(\DateTimeInterface $effectiveDuration): self
    {
        $this->effectiveDuration = $effectiveDuration;

        return $this;
    }
}
