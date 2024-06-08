<?php

namespace App\DataFixtures;

use App\Entity\Habitat;
use App\Entity\Category;
use App\Entity\Ville;
use App\Entity\Pays;
use App\Entity\Option;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

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

        // Création des options
        $options = [
            'Piscine', 'Jacuzzi', 'Sauna', 'Hammam', 'Barbecue', 'Jardin', 'Terrasse', 'Balcon',
            'Vue panoramique', 'Accès plage', 'Accès lac', 'Climatisation', 'Chauffage central', 
            'Cuisine équipée', 'Wifi', 'Télévision', 'Parking', 'Animaux acceptés', 'Non-fumeur',
            'Lit king size', 'Cheminée', 'Machine à laver', 'Sèche-linge', 'Lave-vaisselle',
            'Petit déjeuner inclus', 'Repas inclus', 'Activités guidées', 'Équitation', 'Vélo',
            'Randonnée', 'Plongée', 'Pêche', 'Observation des oiseaux', 'Escalade', 'Kayak',
            'Ski', 'Rafting', 'Golf', 'Tennis', 'Fitness', 'Spa', 'Massage', 'Cours de cuisine',
            'Ateliers artistiques', 'Concierge', 'Location de véhicules', 'Transfert aéroport'
        ];

        foreach ($options as $optionName) {
            $option = (new Option())
                ->setName($optionName)
                ->setSlug($this->slugger->slug($optionName))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()));
            $manager->persist($option);
            $this->addReference($optionName, $option);
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
        for ($i = 1; $i <= 10; $i++) {
            $title = $faker->sentence(6, true);
            $habitat = (new Habitat())
                ->setTitle($title)
                ->setAddress($faker->address)
                ->setCodePostal($faker->postcode)
                ->setCapacity($faker->randomNumber(3))
                ->setNombreDeCouchage($faker->numberBetween(1, 10))
                ->setPrice($faker->randomFloat(2, 100, 1900))
                ->setEnVente($faker->boolean)
                ->setContent($faker->paragraphs(10, true))
                ->setCategory($this->getReference($faker->randomElement($categories)))
                ->addOption($this->getReference($faker->randomElement($options)))
                ->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setVille($this->getReference($faker->randomElement(array_keys($villesMapping))))
                ->setSlug($this->slugger->slug($title));
            $manager->persist($habitat);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
