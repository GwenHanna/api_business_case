<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Basket;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Order;
use App\Entity\Prestation;
use App\Entity\Selection;
use App\Entity\Service;
use App\Entity\User;
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
    private const NB_BASKET = 5;
    private const CATEGORIES = ['Tenue de jour', 'Tenue de soirée', 'Linge de maison', 'Linge de lit', 'Maroquinerie', 'Tenue de soirée'];
    private const SERVICE =
    [
        [
            'name' => 'Nettoyage à sec',
            'price' => 4,
            'picture'   =>  'dry_cleaning.jpg',
            'category' => 'nettoyage'
        ],
        [
            'name' => 'Nettoyage linge délicat',
            'price' => 8,
            'picture'   => 'Card_clean_delicate.jpg',
            'category' => 'nettoyage'
        ],
        [
            'name' => 'Réparation de vêtement',
            'price' => 0,
            'picture'   => 'reparation.jpg',
            'category' => 'autre'
        ],
        [
            'name' => 'Nettoyage du cuire',
            'price' => 1,
            'picture'   => 'clean_leather.jpg',
            'category' => 'nettoyage'

        ],

        [
            'name' => 'Repassage',
            'price' => 3,
            'picture'   => 'ironing.jpg',
            'category' => 'autre'
        ],
        [
            'name' => 'Blanchiment',
            'price' => 5,
            'picture'   => 'Card_care_whitening.jpg',
            'category' => 'soins'
        ],
        [
            'name' => 'Traitement anti-tâche',
            'price' => 5,
            'picture'   => 'Card_anti_stain.jpg',
            'category' => 'soins'
        ],
        [
            'name' => 'Traitement tapis',
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'category' => 'soins'

        ],
        [
            'name' => 'Soin du cuire',
            'price' => 1,
            'picture'   => 'care_leather.jpg',
            'category' => 'soins'
        ]
    ];

    private const ARTICLES =
    [
        [
            "name"      => "Pantalon",
            "category"  => "Tenue de jour",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 10,
            "picture"   =>  ""
        ],
        [
            "name"      => "Jeans",
            "category"  => "Tenue de jour",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 10,
            "picture"   =>  "jeans.jpg"
        ],
        [
            "name"      => "Robe",
            "category"  => "Tenue de jour",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 12,
            "picture"   =>  "dress.jpg"
        ],
        [
            "name"      => "Chemise",
            "category"  => "Tenue de jour",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 8,
            "picture"   => "sweater.jpg"
        ],
        [
            "name"      => "Tee-shirt",
            "category"  => "Tenue de jour",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 5,
            "picture"   => ""
        ],
        [
            "name"      => "Veste",
            "category"  => "Tenue de jour",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 13,
            "picture"   => ""
        ],
        [
            "name"      => "Robe de marier",
            "category"  => "Tenue de soirée",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 45,
            "picture"   => ""
        ],
        [
            "name"      => "Costume",
            "category"  => "Tenue de soirée",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 48,
            "picture"   => ""
        ],
        [
            "name"      => "Drap",
            "category"  => "Linge de maison",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Blanchiment', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 5,
            "picture"   => ""
        ],
        [
            "name"      => "House de couette",
            "category"  => "Linge de maison",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Blanchiment', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 20,
            "picture"   => ""
        ],
        [
            "name"      => "Tapis",
            "category"  => "Linge de maison",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Traitement anti-tâche', 'Traitement tapis'],
            "price"      => 30,
            "picture"   => ""
        ],
        [
            "name"      => "Sac",
            "category"  => "Maroquinerie",
            "service"   => ['Traitement anti-tâche', 'Soin du cuire'],
            "price"      => 15,
            "picture"   => ""
        ],
        [
            "name"      => "Ceinture",
            "category"  => "Maroquinerie",
            "service"   => ['Traitement anti-tâche', 'Soin du cuire'],
            "price"      => 8,
            "picture"   => ""
        ],


    ];

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        $categories = [];
        foreach (self::CATEGORIES as $key => $value) {
            $category = new Category();
            $category->setName($value);
            $manager->persist($category);
            $categories[$value] = $category;
        }
        $manager->flush();

        // Création des services
        $services = [];
        foreach (self::SERVICE as $key => $value) {
            $service = new Service();
            $service
                ->setName($value['name'])
                ->setDescription($faker->realText())
                ->setPrice($value['price'])
                ->setPicture($value['picture'])
                ->setCategory($value['category']);
            $manager->persist($service);
            $services[$value['name']] = $service;
        }

        // Création de l'admin
        $admin = new User();
        $admin
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setGender($faker->title())
            ->setEmail('admin@admin.com')
            ->setBirthdate($faker->dateTime())
            ->setCity($faker->city())
            ->setStreet($faker->streetAddress())
            ->setRoles(["ROLE_ADMIN"])
            ->setZipcode($faker->postcode())
            ->setPassword($this->hasher->hashPassword($admin, 'admin'));

        $manager->persist($admin);

        // Création des utilisateurs
        $users = [];
        for ($i = 0; $i < self::NB_USER; $i++) {
            $user = new User();
            $user
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setGender($faker->title())
                ->setEmail($faker->email())
                ->setBirthdate($faker->dateTime())
                ->setCity($faker->city())
                ->setStreet($faker->streetAddress())
                ->setRoles(["ROLE_USER"])
                ->setZipcode($faker->postcode())
                ->setPassword($this->hasher->hashPassword($user, 'user'));

            $users[] = $user;
            $manager->persist($user);
        }

        // Création des commantaires
        for ($i = 0; $i < self::NB_COMMENT; $i++) {
            $comment = new Comment();
            $comment
                ->setAuthor($faker->randomElement($users))
                ->setContent($faker->realText())
                ->setDateCreated($faker->dateTime())
                ->setScore(rand(1,5));
            $manager->persist($comment);
        }


        $selections = [];
        for ($i = 0; $i < self::NB_ORDERS; $i++) {
            $selection = new Selection();
            $selection
                // ->setServices($faker->randomElement($services))
                ->setQuantity($faker->randomDigitNotNull())
                ->setPriceTotal(10);
            $selections[] = $selection;
            $manager->persist($selection);
        }

        // Création des panier
        $statuBasket = ['waiting', 'confirmed'];
        $baskets = [];
        for ($i = 0; $i < self::NB_BASKET; $i++) {
            $basket = new Basket();
            $basket
                ->setSelection($faker->randomElement($selections))
                ->setStatus($faker->randomElement($statuBasket));

            $baskets[] = $basket;
            $manager->persist($basket);
        }

        // Création des commandes
        $statuOrder = ['waiting', 'start', 'finish'];
        $orders = [];
        foreach ($baskets as $key => $basket) {
            if ($basket->getStatus() === 'confirmed') {
                $order = new Order();
                $order
                    ->setDepotDate($faker->dateTimeInInterval())
                    ->setPayementDate($faker->dateTimeInInterval())
                    ->setPickUpDate($faker->dateTimeBetween())
                    ->setStatus($faker->randomElement($statuOrder));
                if ($order->getStatus() !== 'waiting') {
                    $order->setUser($faker->randomElement($users));
                }
                $manager->persist($order);
            }
        }

        // Création des articles
        $articles = [];
        foreach (self::ARTICLES as $key => $article) {
            $newArticle = new Article();
            $newArticle
                ->setName($article['name'])
                ->setDescription($faker->realText())
                ->setPrice($article['price'])
                ->setState('');
            // ->setCategory()

            $articleServices = [];
            foreach ($article['service'] as $serviceName) {
                if (isset($services[$serviceName])) {
                    $articleServices[] = $services[$serviceName];
                }
            }


            if (isset($categories[$article['category']])) {
                $cat = $categories[$article['category']];
                $newArticle->setCategory($cat);
            }
            $manager->persist($newArticle);
            $manager->flush();
            $articles[] = $newArticle;

            // Création des Prestation
            foreach ($articleServices as $service) {
                $prestation = new Prestation();
                $prestation
                    ->setArticle($newArticle)
                    ->setService($service);
                $manager->persist($prestation);
            }
        }


        $manager->flush();
    }
}
