<?php

namespace App\DataFixtures;

use App\Entity\Habitat;
use App\Entity\Category;
use App\Entity\Ville;
use App\Entity\Pays;
use App\Entity\User;
use App\Entity\Option;
use App\Entity\Quantity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Flex\Options;

class HabitatFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

    public function __construct(private readonly SluggerInterface $slugger)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Création des catégories
        $categories = [
            'Cabane', 'Tente', 'Wigwam', 'Pod', 'Maison flottante', 'Tour d\'observation',
            'Tiny House', 'Bulle', 'Lov\'Nid', 'Roulotte', 'Sphère', 'Studio de jardin',
            'Toue cabanée', 'Ecolo-module', 'Maison modulaire', 'Maison de Hobbit', 'Tipi verre',
            'Zome', 'Cocoon', 'Yourte', 'Kota', 'Dôme', 'Tipi', 'Pyramide', 'Pavillon',
        ];

        foreach ($categories as $categoryName) {
            $category = (new Category())
                ->setName($categoryName)
                ->setSlug($this->slugger->slug($categoryName))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $manager->persist($category);
            $this->addReference($categoryName, $category);
        }

        $units = [
            "m²",
            "m³",
            "Étage",
            "Niveau",
            "Mezzanine",
            "Comble",
            "Lucarne",
            "Tourelle",
            "Pigeonnier",
            "Colombier",
            "Moulin",
            "Maison-tour",
            "Longère",
            "Borie",
            "Cabanon",
            "Capitelle",
            "Cabane",
            "Roulotte",
            "Yourte",
            "Tipi",
            "Igloo",
            "Troglodyte",
            "Paillote",
            "Hutte",
            "Tente",
            "Abri",
            "Bulle",
            "Dôme",
            "Tiny house",
            "Conteneur",
            "Bateau",
            "Péniche"
            ];

        // Création des options
        $options = array_map(fn(string $name)=>(new Option())
            ->setName($name)
            ->setSlug (strtolower($this->slugger->slug($name)))
            ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
            ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime())), [
           "Vues panoramiques uniques et cadre exceptionnel",
"Jardins et espaces extérieurs atypiques (cabanes dans les arbres, maisons sur l'eau, etc.)",
"Kitchenette et coin repas optimisés dans un petit espace (tiny houses, maisons dômes)",
"Chambre et salle de bains intégrées (tiny houses, maisons dômes)",
"Forme aérodynamique et structure solide pour une meilleure résistance aux intempéries (maisons dômes)",
"Meilleure circulation de l'air et répartition efficace de la chaleur grâce à la forme (maisons dômes)",
"Superficie réduite et mobilité (tiny houses)",
"Espaces suroptimisés, mobilier modulaire et autonomie énergétique (tiny houses)",
"Immersion dans des cultures et architectures originales (péniches, huttes, chalets)",
"Confort allié à l'originalité (cabanes dans les arbres)",
"Toile de fond parfaite pour des photos inoubliables (dômes sous les étoiles, granges, gîtes)",
"Possibilité d'installer une structure insolite dans son jardin comme chambre d'amis ou coin détente",
"Expérience de vie en pleine nature dans une bulle transparente (maison bulle)",
"Immersion dans la culture nomade avec une yourte traditionnelle mongole",
"Vivre sur l'eau dans une péniche aménagée ou un bateau insolite",
"Découvrir l'architecture troglodyte en vivant dans une maison creusée dans la roche",
"Séjour insolite dans une roulotte ou tiny house sur roues pour changer de paysage",
"Dormir dans une maison de verre offrant une vue panoramique à 360°"


        ]);

        foreach ($options as $option) {
            // $option = (new Option())
            //     ->setName($optionName)
            //     ->setSlug($this->slugger->slug($optionName))
            //     ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
            //     ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $manager->persist($option);
            // $this->addReference($optionName, $option);
        }

        // Création des pays
        $pays = [
            'France', 'Belgique', 'Suisse', 'Espagne', 'Italie', 'Allemagne', 'Royaume-Uni', 'Portugal', 
            'Pays-Bas', 'Suède', 'Norvège', 'Danemark', 'Finlande', 'Autriche', 'Grèce', 'Irlande',
            'Pologne', 'République tchèque', 'Hongrie', 'Roumanie', 'Bulgarie', 'Croatie', 'Serbie', 'Slovaquie',
            'Slovénie', 'Lituanie', 'Lettonie', 'Estonie','Malte', 'Chypre', 'Islande',
            'Andorre','Liechtenstein', 'Saint-Marin', 'Vatican', 'Albanie', 'Monténégro', 'Bosnie-Herzégovine',
            'Macédoine du Nord', 'Kosovo', 'Moldavie', 'Ukraine', 'Bélarus', 'Russie', 'Turquie'
        ];
        
        foreach ($pays as $paysName) {
            $paysEntity = (new Pays())
                ->setName($paysName)
                ->setCode($faker->countryCode)
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years', 'now')))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years', 'now')));
            $manager->persist($paysEntity);
            $this->addReference($paysName, $paysEntity);
        }

        // Mapping des villes et pays
        $villesMapping = [
            'Paris' => 'France', 'Bruxelles' => 'Belgique', 'Genève' => 'Suisse', 'Madrid' => 'Espagne', 'Rome' => 'Italie', 
            'Berlin' => 'Allemagne', 'Londres' => 'Royaume-Uni', 'Lisbonne' => 'Portugal', 'Amsterdam' => 'Pays-Bas', 
            'Stockholm' => 'Suède', 'Oslo' => 'Norvège', 'Copenhague' => 'Danemark', 'Helsinki' => 'Finlande', 
            'Vienne' => 'Autriche', 'Athènes' => 'Grèce', 'Dublin' => 'Irlande', 'Varsovie' => 'Pologne', 
            'Prague' => 'République tchèque', 'Budapest' => 'Hongrie', 'Bucarest' => 'Roumanie', 'Sofia' => 'Bulgarie', 
            'Zagreb' => 'Croatie', 'Belgrade' => 'Serbie', 'Bratislava' => 'Slovaquie', 'Ljubljana' => 'Slovénie', 
            'Vilnius' => 'Lituanie', 'Riga' => 'Lettonie', 'Tallinn' => 'Estonie',
            'La Valette' => 'Malte', 'Nicosie' => 'Chypre', 'Reykjavik' => 'Islande', 'Andorre-la-Vieille' => 'Andorre', 'Vaduz' => 'Liechtenstein',
            'Tirana' => 'Albanie', 'Podgorica' => 'Monténégro', 'Sarajevo' => 'Bosnie-Herzégovine', 'Skopje' => 'Macédoine du Nord', 
            'Pristina' => 'Kosovo', 'Chisinau' => 'Moldavie', 'Kiev' => 'Ukraine', 'Minsk' => 'Bélarus', 'Moscou' => 'Russie', 
            'Ankara' => 'Turquie'
        ];

        foreach ($villesMapping as $villeName => $paysName) {
            $ville = (new Ville())
                ->setName($villeName)
                ->setLatitude($faker->latitude)
                ->setLongitude($faker->longitude)
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years', 'now')))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years', 'now')))
                ->setPays($this->getReference($paysName));
            $manager->persist($ville);
            $this->addReference($villeName, $ville);
        }

        // Création de 10 habitats
        for ($i = 1; $i <= 9; $i++) {
            $title = $faker->sentence(6, true);
            $habitat = (new Habitat())
                ->setTitle($title)
                ->setAddress($faker->address)
                ->setCapacity($faker->randomNumber(3))
                ->setNombreDeCouchage($faker->numberBetween(1, 9))
                ->setPrice($faker->randomFloat(2, 100, 1900))
                ->setEnVente($faker->boolean)
                ->setContent($faker->paragraphs(10, true))
                ->setCategory($this->getReference($faker->randomElement($categories)))
<<<<<<< HEAD
                // ->addOption($this->getReference($faker->randomElement($options)))
=======
                ->addOption($this->getReference($faker->randomElement($options)))
>>>>>>> f6da19d8a27d760c4cd757fc4d9a593ea6094f61
                ->setUser($this->getReference ('USER'. $faker->numberBetween(1, 9)))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setVille($this->getReference($faker->randomElement(array_keys($villesMapping))))
                ->setSlug($this->slugger->slug($title));

                foreach($faker->randomElements($options, $faker->numberBetween(2, 5)) as $option) {
                    $habitat->addQuantity((new Quantity())
                    ->setQuantity($faker->numberBetween(1, 250))
                    ->setUnit($faker->randomElement($units))
                    ->setOption($option)
                    );
                    }
            $manager->persist($habitat);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
