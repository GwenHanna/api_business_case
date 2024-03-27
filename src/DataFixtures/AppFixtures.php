<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Section;
use App\Entity\ServiceType;
use App\Entity\User;
use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    private const NB_USER = 10;
    private const NB_COMMENT = 10;
    private const NB_ORDERS = 5;
    private const SECTION =
    [
        'nettoyage', 'soins', 'autre'
    ];
    private const SERVICES_TYPE =
    [
        [
            'name' => 'Nettoyage à sec',
            'picture' => 'dry_cleaning.jpg',
            'section' => self::SECTION[0],
            'icon' => 'clean_delicate.svg'
        ],
        [
            'name' => 'Nettoyage linge délicat',
            'picture' => 'Card_clean_delicate.jpg',
            'section' => self::SECTION[0],
            'icon' => 'dry_cleaning.svg'
        ],
        [
            'name' => 'Nettoyage du cuire',
            'picture' => 'clean_leather.jpg',
            'section' => self::SECTION[0],
            'icon' => 'clean_leather.svg'
        ],
        [
            'name' => 'Réparation de vêtement',
            'picture' => 'reparation.jpg',
            'section' => self::SECTION[2],
            'icon' => 'reparation.svg'
        ],
        [
            'name' => 'Repassage',
            'picture' => 'ironing.jpg',
            'section' => self::SECTION[2],
            'icon' => 'ironing.svg'
        ],
        [
            'name' => 'Blanchiment',
            'picture' => 'Card_care_whitening.jpg',
            'section' => self::SECTION[1],
            'icon' => 'care_whitening.svg'
        ],
        [
            'name' => 'Traitement anti-tâche',
            'picture' => 'Card_anti_stain.jpg',
            'section' => self::SECTION[1],
            'icon' => 'anti_stain.svg'

        ],
        [
            'name' => 'Traitement tapis',
            'picture' => 'Card_care_shut_up.jpg',
            'section' => self::SECTION[1],
            'icon' => 'care_shut_up.svg'

        ],
        [
            'name' => 'Soin du cuire',
            'picture' => 'care_leather.jpg',
            'section' => self::SECTION[1],
            'icon' => 'care_leather.svg'

        ],
    ];

    private const GARMENT =
    [
        'Jeans', 'Pantalon en Lin', 'Pantalon Acrylique', 'Robe Acrylique', 'Robe en Soie', 'Chemise', 'Tee-shirt', 'Veste', 'Robe de marier', 'Costume', 'Couette', 'Drap', 'Ceinture', 'Sac', 'Tapis'
    ];
    // Nettoyage à sec Nettoyage linge délicat Réparation de vêtement Repassage
    private const SERVICES =
    [
        [
            'name'  => 'Jeans',
            'service' => 'Nettoyage à sec',
            'price' => 8,
            'picture'   =>  'jeans.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Jeans',
            'service' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   =>  'jeans.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Jeans',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'jeans.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Jeans',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'jeans.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Pantalon en Lin',
            'service' => 'Nettoyage à sec',
            'price' => 9,
            'picture'   => 'clean_leather.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => 'Pantalon en Lin',
            'service' => 'Nettoyage linge délicat',
            'price' => 11,
            'picture'   => 'clean_leather.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => 'Pantalon en Lin',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'clean_leather.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => 'Pantalon en Lin',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'clean_leather.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => 'Pantalon Acrylique',
            'service' => 'Nettoyage à sec',
            'price' => 8,
            'picture'   => 'pants.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Pantalon Acrylique',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'pants.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Pantalon Acrylique',
            'service' => 'Nettoyage linge délicat',
            'price' => 10,
            'picture'   => 'pants.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Pantalon Acrylique',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'pants.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Robe Acrylique',
            'service' => 'Nettoyage à sec',
            'price' => 8,
            'picture'   =>  'dress.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Robe Acrylique',
            'service' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   =>  'dress.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Robe Acrylique',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'dress.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Robe Acrylique',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'dress.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Robe en Soie',
            'service' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   =>  'dress.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Robe en Soie',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'dress.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Robe en Soie',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'dress.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Chemise',
            'service' => 'Nettoyage à sec',
            'price' => 8,
            'picture'   =>  'shirt.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Chemise',
            'service' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   =>  'shirt.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Chemise',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'shirt.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Chemise',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'shirt.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Tee-shirt',
            'service' => 'Nettoyage à sec',
            'price' => 8,
            'picture'   =>  'tshirt.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Tee-shirt',
            'service' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   =>  'tshirt.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Tee-shirt',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'tshirt.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Tee-shirt',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'tshirt.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Veste',
            'service' => 'Nettoyage à sec',
            'price' => 8,
            'picture'   =>  'jacket.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Veste',
            'service' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   =>  'jacket.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Veste',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'jacket.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Veste',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'jacket.jpg',
            'section' => 'autre'
        ],

        [
            'name'  => 'Robe de marier',
            'service' => 'Nettoyage à sec',
            'price' => 60,
            'picture'   =>  'dress_wedding.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Robe de marier',
            'service' => 'Nettoyage linge délicat',
            'price' => 78,
            'picture'   =>  'dress_wedding.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Robe de marier',
            'service' => 'Repassage',
            'price' => 45,
            'picture'   => 'dress_wedding.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Robe de marier',
            'service' => 'Réparation de vêtement',
            'price' => 90,
            'picture'   => 'dress_wedding.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Costume',
            'service' => 'Nettoyage à sec',
            'price' => 8,
            'picture'   =>  'suit.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Costume',
            'service' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   =>  'suit.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Costume',
            'service' => 'Repassage',
            'price' => 5,
            'picture'   => 'suit.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Costume',
            'service' => 'Réparation de vêtement',
            'price' => 10,
            'picture'   => 'suit.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => 'Couette',
            'service' => 'Nettoyage à sec',
            'price' => 35,
            'picture'   =>  'bed.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Couette',
            'service' => 'Nettoyage linge délicat',
            'price' => 45,
            'picture'   =>  'bed.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Couette',
            'service' => 'Blanchiment',
            'price' => 70,
            'picture'   => 'bed.jpg',
            'section' => 'soins'
        ],
        [
            'name'  => 'Drap',
            'service' => 'Nettoyage à sec',
            'price' => 35,
            'picture'   =>  'sheet.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Drap',
            'service' => 'Nettoyage linge délicat',
            'price' => 45,
            'picture'   =>  'sheet.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Drap',
            'service' => 'Blanchiment',
            'price' => 70,
            'picture'   => 'sheet.jpg',
            'section' => 'soins'
        ],
        [
            'name'  => 'Ceinture',
            'service' => 'Nettoyage du cuire',
            'price' => 35,
            'picture'   =>  'belt.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Ceinture',
            'service' => 'Soin du cuire',
            'price' => 45,
            'picture'   =>  'belt.jpg',
            'section' => 'soins'
        ],
        [
            'name'  => 'Sac',
            'service' => 'Nettoyage du cuire',
            'price' => 35,
            'picture'   =>  'bag.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Sac',
            'service' => 'Soin du cuire',
            'price' => 70,
            'picture'   => 'bag.jpg',
            'section' => 'soins'
        ],
        [
            'name'  => 'Tapis',
            'service' => 'Traitement tapis',
            'price' => 8,
            'picture'   =>  'Card_care_shut_up.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => 'Tapis',
            'service' => 'Traitement anti-tâche',
            'price' => 8,
            'picture'   =>  'Card_care_shut_up.jpg',
            'section' => 'nettoyage'
        ],


    ];

    // Méthode utilisée pour charger des données dans la base de données
    public function load(ObjectManager $manager): void
    {


        $faker = Factory::create('fr_FR');
        $sections = [];
        foreach (self::SECTION as $sectionName) {
            $section = new Section();
            $section->setName($sectionName);
            $sections[] = $section;
            $manager->persist($section);
        }

        $serviceTypes = [];
        // Parcours des données de types de service définies dans la constante SERVICES_TYPE
        foreach (self::SERVICES_TYPE as $serviceTypeData) {

            // Création d'une nouvelle instance de la classe ServiceType
            $serviceType = new ServiceType();

            // Configuration des propriétés du ServiceType
            $serviceType
                ->setName($serviceTypeData['name'])
                ->setDescription($faker->realText())
                ->setPicture($serviceTypeData['picture'])
                ->setIcon($serviceTypeData['icon']);

            // Recherche de la Section associée dans la liste des Sections
            foreach ($sections as $section) {
                if ($section->getName() === $serviceTypeData['section']) {
                    // Attribution de la Section trouvée au ServiceType
                    $serviceType->setSection($section);
                    break;
                }
            }
            // Ajout du ServiceType à la liste
            $serviceTypes[] = $serviceType;
            // Persistance du ServiceType avec Doctrine
            $manager->persist($serviceType);
        }

        $articles = [];
        foreach (self::SERVICES as $serviceData) {
            $article = new Article();
            $article
                ->setName($serviceData['name'])
                ->setPicture($serviceData['picture'])
                ->setPrice($serviceData['price']);

            foreach ($serviceTypes as $serviceType) {
                if ($serviceType->getName() === $serviceData['service']) {
                    $article->setServiceType($serviceType);
                    break;
                }
            }

            $articles[] = $article;
            $manager->persist($article);
        }



        // Création Users
        $users = [];
        for ($i = 0; $i < self::NB_USER; $i++) {
            $user = new User();

            $user
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setBirthdate($faker->dateTime())
                ->setCity($faker->city())
                ->setDateCreated($faker->dateTime())
                ->setEmail($faker->email())
                ->setGender($faker->title())
                ->setPassword($this->hasher->hashPassword($user, 'user123'))
                ->setStreet($faker->postcode())
                ->setStreet($faker->streetAddress())
                ->setRoles(["ROLE_USER"])
                ->setZipcode($faker->postcode());
            $users[] = $user;
            $manager->persist($user);
        }

        // Création Custom User

        $employee = new User();

        $employee
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setBirthdate($faker->dateTime())
            ->setCity($faker->city())
            ->setDateCreated($faker->dateTime())
            ->setEmail('user@employee.com')
            ->setGender($faker->title())
            ->setPassword($this->hasher->hashPassword($employee, 'employee123'))
            ->setStreet($faker->postcode())
            ->setStreet($faker->streetAddress())
            ->setRoles(["ROLE_EMPLOYEE"])
            ->setZipcode($faker->postcode());

        $manager->persist($employee);

        // Création Admin

        $admin = new User();

        $admin
            ->setFirstname('Gwen')
            ->setLastname($faker->lastName())
            ->setBirthdate($faker->dateTime())
            ->setCity($faker->city())
            ->setDateCreated($faker->dateTime())
            ->setEmail('admin@admin.com')
            ->setGender($faker->title())
            ->setPassword($this->hasher->hashPassword($admin, 'admin123'))
            ->setStreet($faker->postcode())
            ->setStreet($faker->streetAddress())
            ->setRoles(["ROLE_ADMIN"])
            ->setZipcode($faker->postcode());

        $manager->persist($admin);

        for ($i = 0; $i < self::NB_COMMENT; $i++) {
            $comment = new Comment();

            $comment
                ->setContent($faker->realText())
                ->setAuthor($faker->randomElement($users))
                ->setDateCreated($faker->dateTime())
                ->setScore($faker->numberBetween(1, 5));


            $manager->persist($comment);
        }

        $articles = [];



        // // Création des articles
        // for ($i = 0; $i < self::NB_ORDERS; $i++) {
        //     $article = new Article();

        //     // Assurez-vous que votre propriété setOrderId attend une instance d'Order
        //     $article->setService($faker->randomElement($services));
        //     $articles[] = $article;
        //     $manager->persist($article);
        // }

        for ($i = 0; $i < self::NB_ORDERS; $i++) {
            $order = new Order();
            $order
                ->setUser($faker->randomElement($users))
                ->setStatus('')
                ->setPayementDate($faker->dateTime('now'))
                ->setDepotDate($faker->dateTime('now'))
                ->setStatus('En attente')
                ->setArticle($faker->randomElement($articles));

            $manager->persist($order);
        }

        // Exécution des opérations d'écriture dans la base de données
        $manager->flush();
    }
}
