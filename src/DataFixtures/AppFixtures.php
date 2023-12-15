<?php

namespace App\DataFixtures;

use App\Entity\Basket;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Order;
use App\Entity\Prestation;
use App\Entity\Section;
use App\Entity\Selection;
use App\Entity\Service;
use App\Entity\ServiceType;
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
    private const SECTION = 
    [
        'nettoyage', 'soins', 'autre'
    ];
    private const SERVICES_TYPE = 
    [
        [
            'name' => 'Nettoyage à sec',
            'picture' => 'dry_cleaning.jpg',
            'section' => self::SECTION[0]
        ],
        [
            'name' => 'Nettoyage linge délicat',
            'picture' => 'Card_clean_delicate.jpg',
            'section' => self::SECTION[0]
        ],
        [
            'name' => 'Nettoyage du cuire',
            'picture' => 'care_leather.jpg',
            'section' => self::SECTION[0]
        ],
        [
            'name' => 'Réparation de vêtement',
            'picture' => 'reparation.jpg',
            'section' => self::SECTION[2]
        ],
        [
            'name' => 'Repassage',
            'picture' => 'ironing.jpg',
            'section' => self::SECTION[1]
        ],
        [
            'name' => 'Blanchiment',
            'picture' => 'ironing.jpg',
            'section' => self::SECTION[2]
        ],
        [
            'name' => 'Traitement anti-tâche',
            'picture' => 'Card_anti_stain.jpg',
            'section' => self::SECTION[2]

        ],
        [
            'name' => 'Traitement tapis',
            'picture' => 'Card_care_shut_up.jpg',
            'section' => self::SECTION[2]

        ],
        [
            'name' => 'Soin du cuire',
            'picture' => 'clean_leather.jpg',
            'section' => self::SECTION[2]

        ],
    ];

    private const GARMENT = 
    [
        'Jeans','Pantalon en Lin','Pantalon Acrylique ','Robe Acrylique', 'Robe en Soie','Chemise', 'Tee-shirt', 'Veste','Robe de marier','Costume','Couette', 'Drap','Ceinture', 'Sac','Tapis'
    ];

    private const SERVICES =
    [
        [
            'name'  => self::GARMENT[0],
            'service' => self::SERVICES_TYPE[0],
            'price' => 4,
            'picture'   =>  'dry_cleaning.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => self::GARMENT[0],
            'service' => self::SERVICES_TYPE[3],
            'price' => 8,
            'picture'   => 'Card_clean_delicate.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => self::GARMENT[0],
            'service' => self::SERVICES_TYPE[4],
            'price' => 0,
            'picture'   => 'reparation.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => self::GARMENT[1],
            'service' => self::SERVICES_TYPE[0],
            'price' => 1,
            'picture'   => 'clean_leather.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[1],
            'service' => self::SERVICES_TYPE[1],
            'price' => 1,
            'picture'   => 'clean_leather.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[1],
            'service' => self::SERVICES_TYPE[3],
            'price' => 1,
            'picture'   => 'clean_leather.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[1],
            'service' => self::SERVICES_TYPE[4],
            'price' => 1,
            'picture'   => 'clean_leather.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[2],
            'service' => self::SERVICES_TYPE[0],
            'price' => 3,
            'picture'   => 'ironing.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => self::GARMENT[2],
            'service' => self::SERVICES_TYPE[3],
            'price' => 3,
            'picture'   => 'ironing.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => self::GARMENT[3],
            'service' => self::SERVICES_TYPE[0],
            'price' => 5,
            'picture'   => 'Card_care_whitening.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => self::GARMENT[3],
            'service' => self::SERVICES_TYPE[3],
            'price' => 5,
            'picture'   => 'Card_care_whitening.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => self::GARMENT[3],
            'service' => self::SERVICES_TYPE[4],
            'price' => 5,
            'picture'   => 'Card_care_whitening.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => self::GARMENT[4],
            'service' => self::SERVICES_TYPE[1],
            'price' => 5,
            'picture'   => 'Card_anti_stain.jpg',
            'section' => 'nettoyage'
        ],
        [
            'name'  => self::GARMENT[4],
            'service' => self::SERVICES_TYPE[4],
            'price' => 5,
            'picture'   => 'Card_anti_stain.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => self::GARMENT[4],
            'service' => self::SERVICES_TYPE[4],
            'price' => 5,
            'picture'   => 'Card_anti_stain.jpg',
            'section' => 'autre'
        ],
        [
            'name'  => self::GARMENT[5],
            'service' => self::SERVICES_TYPE[0],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[5],
            'service' => self::SERVICES_TYPE[1],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[5],
            'service' => self::SERVICES_TYPE[3],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[5],
            'service' => self::SERVICES_TYPE[4],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[5],
            'service' => self::SERVICES_TYPE[0],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[6],
            'service' => self::SERVICES_TYPE[1],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[6],
            'service' => self::SERVICES_TYPE[3],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[6],
            'service' => self::SERVICES_TYPE[4],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[7],
            'service' => self::SERVICES_TYPE[0],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[7],
            'service' => self::SERVICES_TYPE[1],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[7],
            'service' => self::SERVICES_TYPE[3],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[7],
            'service' => self::SERVICES_TYPE[4],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[9],
            'service' => self::SERVICES_TYPE[0],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[9],
            'service' => self::SERVICES_TYPE[1],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[9],
            'service' => self::SERVICES_TYPE[3],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
        [
            'name'  => self::GARMENT[9],
            'service' => self::SERVICES_TYPE[4],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],

        [
            'name'  => self::GARMENT[10],
            'service' => self::SERVICES_TYPE[0],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[10],
            'service' => self::SERVICES_TYPE[1],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[10],
            'service' => self::SERVICES_TYPE[5],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => self::SERVICES_TYPE[5]

        ],
        [
            'name'  => self::GARMENT[11],
            'service' => self::SERVICES_TYPE[0],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[11],
            'service' => self::SERVICES_TYPE[1],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[11],
            'service' => self::SERVICES_TYPE[5],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => self::SERVICES_TYPE[5]

        ],

        [
            'name'  => self::GARMENT[12],
            'service' => self::SERVICES_TYPE[2],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[12],
            'service' => self::SERVICES_TYPE[8],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'soins'

        ],
        [
            'name'  => self::GARMENT[13],
            'service' => self::SERVICES_TYPE[2],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'nettoyage'

        ],
        [
            'name'  => self::GARMENT[13],
            'service' => self::SERVICES_TYPE[8],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'soins'

        ],
        [
            'name'  => self::GARMENT[14],
            'service' => self::SERVICES_TYPE[7],
            'price' => 1,
            'picture'   => 'Card_care_shut_up.jpg',
            'section' => 'autre'

        ],
      
    ];

    // private const SERVICES =
    // [
    //     [
    //         "name"      => "Pantalon",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 10,
    //         "picture"   =>  "pants.jpg"
    //     ],
    //     [
    //         "name"      => "Jeans",
    //         "category"  => "Tenue de jour",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 10,
    //         "picture"   =>  "jeans.jpg"
    //     ],
    //     [
    //         "name"      => "Robe",
    //         "category"  => "Tenue de jour",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 12,
    //         "picture"   =>  "dress.jpg"
    //     ],
    //     [
    //         "name"      => "Chemise",
    //         "category"  => "Tenue de jour",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 8,
    //         "picture"   => "sweater.jpg"
    //     ],
    //     [
    //         "name"      => "Tee-shirt",
    //         "category"  => "Tenue de jour",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 5,
    //         "picture"   => "tshirt.jpg"
    //     ],
    //     [
    //         "name"      => "Veste",
    //         "category"  => "Tenue de jour",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 13,
    //         "picture"   => "jacket.jpg"
    //     ],
    //     [
    //         "name"      => "Robe de marier",
    //         "category"  => "Tenue de soirée",
    //         "service"   => [ 'Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 45,
    //         "picture"   => "dress_wedding.jpg"
    //     ],
    //     [
    //         "name"      => "Costume",
    //         "category"  => "Tenue de soirée",
    //         "service"   => ['Nettoyage linge délicat', 'Réparation de vêtement', 'Repassage'],
    //         "price"      => 48,
    //         "picture"   => "suit.jpg"
    //     ],
    //     [
    //         "name"      => "Drap",
    //         "category"  => "Linge de maison",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Blanchiment', 'Repassage', 'Traitement anti-tâche'],
    //         "price"      => 5,
    //         "picture"   => "sheet.jpg"
    //     ],
    //     [
    //         "name"      => "Couette",
    //         "category"  => "Linge de maison",
    //         "service"   => ['Nettoyage à sec', 'Nettoyage linge délicat', 'Blanchiment', 'Traitement anti-tâche'],
    //         "price"      => 20,
    //         "picture"   => "bed.jpg"
    //     ],
    //     [
    //         "name"      => "Tapis",
    //         "category"  => "Linge de maison",
    //         "service"   => [ 'Traitement anti-tâche', 'Traitement tapis'],
    //         "price"      => 30,
    //         "picture"   => "Card_care_shut_up.jpg"
    //     ],
    //     [
    //         "name"      => "Sac",
    //         "category"  => "Maroquinerie",
    //         "service"   => [ 'Soin du cuire', 'Nettoyage du cuire'],
    //         "price"      => 15,
    //         "picture"   => "bag.jpg"
    //     ],
    //     [
    //         "name"      => "Ceinture",
    //         "category"  => "Maroquinerie",
    //         "service"   => ['Soin du cuire', 'Nettoyage du cuire'],
    //         "price"      => 8,
    //         "picture"   => "belt.jpg"
    //     ],


    // ];


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
        foreach (self::SERVICES_TYPE as $serviceTypeData) {
            $serviceType = new ServiceType();
            $serviceType
                ->setName($serviceTypeData['name'])
                ->setDescription($faker->realText())
                ->setPicture($serviceTypeData['picture']);
    
            foreach ($sections as $section) {
                if ($section->getName() === $serviceTypeData['section']) {
                    $serviceType->setSection($section);
                    break;
                }
            }
    
            $serviceTypes[] = $serviceType;
            $manager->persist($serviceType);
        }
    
        $services = [];
        foreach (self::SERVICES as $serviceData) {
            $service = new Service();
            $service
                ->setName($serviceData['name'])
                ->setPicture($serviceData['picture'])
                ->setPrice($serviceData['price']);
    
            foreach ($serviceTypes as $serviceType) {
                if ($serviceType->getName() === $serviceData['service']['name']) {
                    $service->setServiceType($serviceType);
                    break;
                }
            }
    
            $services[] = $service;
            $manager->persist($service);
        }

   

        // Création Users
        for ($i=0; $i < self::NB_USER; $i++) { 
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
         ->setRoles(["ROLE_ADMIN", "ROLE_EMPLOYEE"])
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

        $manager->flush();
    }
}
