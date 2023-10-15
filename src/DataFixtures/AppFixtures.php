<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Basket;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Order;
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
    private const CATEGORIES = ['Vêtement', 'Linge de maison', 'Linge de lit', 'Maroquinerie', 'Tenue de soirée'];
    private const SERVICE =
    [
        [
            'name' => 'Nettoyage à sec',
            'price' => 4
        ],
        [
            'name' => 'Nettoyage linge délicat',
            'price' => 8
        ],
        [
            'name' => 'Réparation de vêtement',
            'price' => 0
        ],
        [
            'name' => 'Nettoyage du cuire',
            'price' => 10
        ],
        [
            'name' => 'Soin du cuire',
            'price' => 12
        ],
        [
            'name' => 'Repassage',
            'price' => 3
        ],
        [
            'name' => 'Blanchiment',
            'price' => 5
        ],
        [
            'name' => 'Traitement anti-tâche',
            'price' => 5
        ],
        [
            'name' => 'Traitement tapis',
            'price' => 15
        ]
    ];

    private const ARTICLES =
    [
        [
            "name"      => "Pantalon",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 10
        ],
        [
            "name"      => "Jeans",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 10
        ],
        [
            "name"      => "Robe",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 12
        ],
        [
            "name"      => "Chemise",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 8
        ],
        [
            "name"      => "Tee-shirt",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 5
        ],
        [
            "name"      => "Veste",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 13
        ],
        [
            "name"      => "Robe de marier",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 45
        ],
        [
            "name"      => "Costume",
            "category"  => "Vêtement",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 48
        ],
        [
            "name"      => "Drap",
            "category"  => "Linge de maison",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Blanchiment', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 5
        ],
        [
            "name"      => "House de couette",
            "category"  => "Linge de maison",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Blanchiment', 'Repassage', 'Traitement anti-tâche'],
            "price"      => 20
        ],
        [
            "name"      => "Tapis",
            "category"  => "Linge de maison",
            "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Traitement anti-tâche', 'Traitement tapis'],
            "price"      => 30
        ],
        [
            "name"      => "Sac",
            "category"  => "Maroquinerie",
            "service"   => ['Traitement anti-tâche', 'Soin du cuire'],
            "price"      => 15
        ],
        [
            "name"      => "Ceinture",
            "category"  => "Maroquinerie",
            "service"   => ['Traitement anti-tâche', 'Soin du cuire'],
            "price"      => 8
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

        // Création des services
        $services = [];
        foreach (self::SERVICE as $key => $value) {
            $service = new Service();
            $service
                ->setName($value['name'])
                ->setDescription($faker->realText())
                ->setPrice($value['price']);
            $manager->persist($service);
            $services[$value['name']] = $service;
        }

        // Création des articles
        foreach (self::ARTICLES as $key => $value) {
            $article = new Article();
            $article
                ->setName($value['name'])
                ->setDescription($faker->realText())
                ->setPrice($value['price'])
                ->setState('');

            $articleServices = [];
            foreach ($value['service'] as $serviceName) {
                if (isset($services[$serviceName])) {
                    $articleServices[] = $services[$serviceName];
                }
            }
            foreach ($articleServices as $service) {
                $article->addService($service);
            }

            if (isset($categories[$value['category']])) {
                $cat = $categories[$value['category']];
                $article->setCategory($cat);
            }
            $manager->persist($article);
        }

        // Création de l'admin
        $admin = new User();
        $admin
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setGender($faker->title())
            ->setEmail($faker->email())
            ->setBirthdate($faker->dateTime())
            ->setCity($faker->city())
            ->setStreet($faker->streetAddress())
            ->setRoles(["ROLE_ADMIN"])
            ->setZipcode($faker->postcode())
            ->setPassword($this->hasher->hashPassword($admin, 'user'));

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
                ->setDateCreated($faker->dateTime());
            $manager->persist($comment);
        }


        $selections = [];
        for ($i = 0; $i < self::NB_ORDERS; $i++) {
            $selection = new Selection();
            $selection
                ->setServices($faker->randomElement($services))
                ->setQuantity($faker->randomDigitNotNull())
                ->setPriceTotal(10);
            $selections[] = $selection;
            $manager->persist($selection);
        }

        // Création des panier
        $statuBasket = ['attente', 'confirmed'];
        $baskets = [];
        for ($i = 0; $i < self::NB_ORDERS; $i++) {
            $basket = new Basket();
            $basket
                ->setSelection($faker->randomElement($selections))
                ->setStatus($faker->randomElement($statuBasket));

            $baskets[] = $basket;
            $manager->persist($basket);
        }

        // Création des commandes
        $statuOrder = ['attente', 'start', 'finish'];
        $orders = [];
        foreach ($baskets as $key => $value) {
            if ($value->getStatus() === 'confirmed') {
                $order = new Order();
                $order
                    ->setDepotDate($faker->dateTimeInInterval())
                    ->setPayementDate($faker->dateTimeInInterval())
                    ->setPickUpDate($faker->dateTimeBetween())
                    ->setStatus($faker->randomElement($statuOrder));
                if ($order->getStatus() !== 'attente') {
                    $order->setUser($faker->randomElement($users));
                }
            }
            $manager->persist($order);
        }

        $manager->flush();
    }
}
