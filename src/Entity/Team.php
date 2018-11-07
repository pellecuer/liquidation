<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Agenda", mappedBy="team")
     */
    private $agenda;

    public function __construct()
    {
        $this->agenda = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Agenda[]
     */
    public function getAgenda(): Collection
    {
        return $this->agenda;
    }

    public function addAgenda(Agenda $agenda): self
    {
        if (!$this->agenda->contains($agenda)) {
            $this->agenda[] = $agenda;
            $agenda->setTeam($this);
        }

        return $this;
    }

    public function removeAgenda(Agenda $agenda): self
    {
        if ($this->agenda->contains($agenda)) {
            $this->agenda->removeElement($agenda);
            // set the owning side to null (unless already changed)
            if ($agenda->getTeam() === $this) {
                $agenda->setTeam(null);
            }
        }

        return $this;
    }
}
