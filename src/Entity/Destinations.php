<?php

namespace App\Entity;

use App\Repository\DestinationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DestinationsRepository::class)
 */
class Destinations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(maxSize="6000000", maxSizeMessage="le fichier est trop lourd({{ size }} {{ suffix }}"),
     */
    private $image_pays;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *     min=100,
     *     max=1000contraint)
     */
    private $description_pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hebergement;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getImagePays(): ?string
    {
        return $this->image_pays;
    }

    public function setImagePays(string $image_pays): self
    {
        $this->image_pays = $image_pays;

        return $this;
    }

    public function getDescriptionPays(): ?string
    {
        return $this->description_pays;
    }

    public function setDescriptionPays(string $description_pays): self
    {
        $this->description_pays = $description_pays;

        return $this;
    }

    public function getHebergement(): ?string
    {
        return $this->hebergement;
    }

    public function setHebergement(string $hebergement): self
    {
        $this->hebergement = $hebergement;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
