<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VMRepository")
 */
class VM
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdVM;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NazwaVM;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $Ip;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Backup", mappedBy="VM", orphanRemoval=true)
     */
    private $backups;

    public function __construct()
    {
        $this->backups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVM(): ?int
    {
        return $this->IdVM;
    }

    public function setIdVM(int $IdVM): self
    {
        $this->IdVM = $IdVM;

        return $this;
    }

    public function getNazwaVM(): ?string
    {
        return $this->NazwaVM;
    }

    public function setNazwaVM(string $NazwaVM): self
    {
        $this->NazwaVM = $NazwaVM;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->Ip;
    }

    public function setIp(?string $Ip): self
    {
        $this->Ip = $Ip;

        return $this;
    }

    /**
     * @return Collection|Backup[]
     */
    public function getBackups(): Collection
    {
        return $this->backups;
    }

    public function addBackup(Backup $backup): self
    {
        if (!$this->backups->contains($backup)) {
            $this->backups[] = $backup;
            $backup->setVM($this);
        }

        return $this;
    }

    public function removeBackup(Backup $backup): self
    {
        if ($this->backups->contains($backup)) {
            $this->backups->removeElement($backup);
            // set the owning side to null (unless already changed)
            if ($backup->getVM() === $this) {
                $backup->setVM(null);
            }
        }

        return $this;
    }
}
