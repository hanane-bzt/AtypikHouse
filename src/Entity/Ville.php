<?php

namespace App\Entity;

use App\Repository\CityRepository;
use App\Validator\BanWord;
use Doctrine\DBAL\Types\Types;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: CityRepository::class)]
#[UniqueEntity('name')]
#[UniqueEntity('slug')]
#[Vich\Uploadable()] 
class Ville
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3)]
    #[Groups(['habitats.show'])]
    private string $name = '';

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3)]
    #[Assert\Regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', message: "Le slug ne peut contenir que des lettres minuscules, des chiffres et des tirets")]
     private string $slug = '';

     #[ORM\Column(type: 'decimal', precision: 10, scale: 7)]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'numeric', message: 'La latitude doit être un nombre')]
    #[Assert\Range(min: -90, max: 90, notInRangeMessage: 'La latitude doit être comprise entre -90 et 90')]
    private $latitude;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 7)]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'numeric', message: 'La longitude doit être un nombre')]
    #[Assert\Range(min: -180, max: 180, notInRangeMessage: 'La longitude doit être comprise entre -180 et 180')]
    private $longitude;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;


    // #[ORM\ManyToOne(inversedBy: 'countries',  cascade: ['remove'])]
    // private ?Pays $pays = null;

    
    #[ORM\ManyToOne(targetEntity: Pays::class, inversedBy: 'villes')]
    #[ORM\JoinColumn(nullable: false)]
    private Pays $pays;

    /** */
    #[ORM\OneToMany(targetEntity: Habitat::class, mappedBy: 'ville', cascade: ['remove'])]
    private Collection $habitats;

    public function __construct()
    {
        $this->habitats = new ArrayCollection();
    }
    /** */

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }


    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

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


    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }


    /** */
    
    /**
     * @return Collection<int, Habitat>
     */
    public function getHabitats(): Collection
    {
        return $this->habitats;
    }

    public function addHabitat(Habitat $habitat): static
    {
        if (!$this->habitats->contains($habitat)) {
            $this->habitats->add($habitat);
            $habitat->setVille($this);
        }

        return $this;
    }

    public function removeHabitat(Habitat $habitat): static
    {
        if ($this->habitats->removeElement($habitat)) {
            // set the owning side to null (unless already changed)
            if ($habitat->getVille() === $this) {
                $habitat->setVille(null);
            }
        }

        return $this;
    }

        /** */

}



// namespace App\Entity;

// use App\Repository\VilleRepository;
// use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Validator\Constraints as Assert;

// #[ORM\Entity(repositoryClass: VilleRepository::class)]
// class Ville
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column(type: 'integer')]
//     private ?int $id;

//     #[ORM\Column(type: 'string', length: 255)]
//     #[Assert\NotBlank]
//     #[Assert\Length(min: 2, max: 255)]
//     private string $nom;

//     #[ORM\Column(type: 'string', length: 10)]
//     #[Assert\NotBlank]
//     #[Assert\Length(min: 5, max: 10)]
//     private string $codePostal;

   

//     #[ORM\Column(type: 'datetime_immutable')]
//     private $createdAt;

//     #[ORM\Column(type: 'datetime_immutable')]
//     private $updatedAt;

//     #[ORM\ManyToOne(targetEntity: Pays::class, inversedBy: 'villes')]
//     #[ORM\JoinColumn(nullable: false)]
//     private Pays $pays;

//     public function getId(): ?int
//     {
//         return $this->id;
//     }

//     public function getNom(): ?string
//     {
//         return $this->nom;
//     }

//     public function setNom(string $nom): self
//     {
//         $this->nom = $nom;

//         return $this;
//     }

//     public function getCodePostal(): ?string
//     {
//         return $this->codePostal;
//     }

//     public function setCodePostal(string $codePostal): self
//     {
//         $this->codePostal = $codePostal;

//         return $this;
//     }

   

//     public function getCreatedAt(): ?\DateTimeImmutable
//     {
//         return $this->createdAt;
//     }

//     public function setCreatedAt(\DateTimeImmutable $createdAt): self
//     {
//         $this->createdAt = $createdAt;

//         return $this;
//     }

//     public function getUpdatedAt(): ?\DateTimeImmutable
//     {
//         return $this->updatedAt;
//     }

//     public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
//     {
//         $this->updatedAt = $updatedAt;

//         return $this;
//     }

//     public function getPays(): ?Pays
//     {
//         return $this->pays;
//     }

//     public function setPays(?Pays $pays): self
//     {
//         $this->pays = $pays;

//         return $this;
//     }
// }
