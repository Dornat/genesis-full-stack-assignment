<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Astrologer;

class AstrologerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $astrologer = new Astrologer();
            $firstName = $faker->firstName($faker->boolean ? 'male' : 'female');
            $lastName = $faker->lastName;
            $astrologer->setName($firstName);
            $astrologer->setPersonalInfo($firstName . ' ' . $lastName);
            $astrologer->setEmail($faker->safeEmail);
            $astrologer->setBio($faker->paragraph);
            $astrologer->setPhoto('https://robohash.org/' . $faker->word);

            // Adding random services.
            for ($j = 0; $j < 7; $j++) {
                if ($faker->boolean(70)) {
                    /** @var Service $service */
                    $service = $this->getReference(ServiceFixtures::SERVICE . $faker->numberBetween(1, 7));
                    $services = $astrologer->getServices();
                    if (!is_null($services->get($service->getId()))) continue;
                    $astrologer->addService($service);
                }
            }

            $manager->persist($astrologer);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            ServiceFixtures::class
        ];
    }
}
