<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ServiceFixtures extends Fixture
{
    const SERVICE = 'service';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 7; $i++) {
            $service = new Service();
            $service->setName($faker->sentence(3));
            $service->setDescription($faker->paragraph);
            $service->setPrice($faker->numberBetween(10, 100));
            $manager->persist($service);
            $this->setReference(self::SERVICE . ($i + 1), $service);
        }

        $manager->flush();
    }
}
