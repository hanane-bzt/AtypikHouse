<?php

namespace App\Entity;

use App\Repository\HabitatRepository;
use App\Validator\BanWord;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: HabitatRepository::class)]
#[UniqueEntity('title')]
#[UniqueEntity('slug')]
#[Vich\Uploadable()]
class Habitat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['habitats.index'])]

    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'habitat', targetEntity: Reservation::class, cascade: ['persist', 'remove'])]
    private Collection $reservations;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 5)]
    #[BanWord]
    #[Groups(['habitats.index','habitats.create'])]
    private string $title = '';
    
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min: 10)]
    #[Groups(['habitats.index','habitats.create'])]
    private string $address = '';

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    #[Assert\Type(type: 'numeric', message: 'La capacité doit être un nombre')]
    #[Assert\NotBlank(message: 'La capacité ne peut pas être vide')]
    #[Assert\Positive(message: 'La capacité doit être un nombre positif')]
    #[Groups(['habitats.show','habitats.create'])]
    private ?string $capacity = '';
    
    #[ORM\Column]
    #[Assert\Positive(message: "The number of beds must be positive")]
    #[Groups(['habitats.index','habitats.create'])]
    private int $nombreDeCouchage = 1; // Default value of 1

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    #[Assert\Positive()]
    #[Assert\LessThan(value: 2000)]
    #[Groups(['habitats.index','habitats.create'])]
    private string $price = '';

    #[ORM\Column]
    #[Groups(['habitats.index','habitats.create'])]
    private ?bool $en_vente = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min: 15)]
    #[Groups(['habitats.show','habitats.create'])]
    private string $content = '';

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 5)]
    #[Assert\Regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', message: "Le slug ne peut contenir que des lettres minuscules, des chiffres et des tirets")]
    #[Groups(['habitats.index','habitats.create'])]
    private string $slug = '';

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['habitats.show'])]
    private ?string $file = null;

    #[Vich\UploadableField(mapping: 'habitats', fileNameProperty: 'file')]
    #[Assert\Image()]
    private ?File $thumbnailFile = null;

    #[ORM\ManyToOne(inversedBy: 'habitats', cascade: ['persist'])]
    #[Groups(['habitats.index','habitats.create'])]
    private ?Category $category = null;

    // #[ORM\ManyToOne(inversedBy: 'options', cascade: [' persist'])]    
    // private ?Option $option = null;
    #[Groups(['habitats.index','habitats.create'])]
    #[ORM\ManyToOne(inversedBy: 'cities', cascade: ['persist'])]
// /**
//  * @ORM\JoinColumn(name="ville_id", referencedColumnName="id", onDelete="SET NULL")
//  */
private ?Ville $ville = null;


    // #[ORM\ManyToMany(targetEntity: Option::class, inversedBy: 'habitats')]
    // private Collection $options;

    #[ORM\ManyToMany(targetEntity: Option::class)]
    private Collection $options;
    

    #[Groups(['habitats.index','habitats.create'])]
    #[ORM\ManyToOne(inversedBy: 'habitats', cascade: ['persist'])]
    private ?User $user = null;

    /**
     * @var Collection<int, Quantity>
     */
    #[ORM\OneToMany(targetEntity: Quantity::class, mappedBy: 'habitat', orphanRemoval: true, cascade: ['persist'])]
    private Collection $quantities;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->quantities = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getNombreDeCouchage(): ?int
    {
        return $this->nombreDeCouchage;
    }

    public function setNombreDeCouchage(int $nombreDeCouchage): static
    {
        $this->nombreDeCouchage = $nombreDeCouchage;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isEnVente(): ?bool
    {
        return $this->en_vente;
    }

    public function setEnVente(bool $en_vente): static
    {
        $this->en_vente = $en_vente;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getThumbnailFile(): ?File
    {
        return $this->thumbnailFile;
    }

    public function setThumbnailFile(?File $thumbnailFile): static
    {
        $this->thumbnailFile = $thumbnailFile;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Option>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options->add($option);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        $this->options->removeElement($option);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setHabitat($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getHabitat() === $this) {
                $reservation->setHabitat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Quantity>
     */
    public function getQuantities(): Collection
    {
        return $this->quantities;
    }

    public function addQuantity(Quantity $quantity): static
    {
        if (!$this->quantities->contains($quantity)) {
            $this->quantities->add($quantity);
            $quantity->setHabitat($this);
        }

        return $this;
    }

    public function removeQuantity(Quantity $quantity): static
    {
        if ($this->quantities->removeElement($quantity)) {
            // set the owning side to null (unless already changed)
            if ($quantity->getHabitat() === $this) {
                $quantity->setHabitat(null);
            }
        }

        return $this;
    }
}
