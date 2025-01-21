<?php

namespace App\Test\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\CoasterRepository;

class CoasterControllerTest extends WebTestCase{
    public function testIndex(){
        $client = static::createClient();

        $client->request('GET', '/coaster/');   

        //code 200 en retour
        $this->assertResponseIsSuccessful();
    }

    public function testEdit(){
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $adminUser = $userRepository->findOneBy(['username' => 'admin']);
        $client->loginUser($adminUser);

        $client->request('GET', '/coaster/add'); 

        $this->assertResponseIsSuccessful();
    }

    public function testNew(){
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $adminUser = $userRepository->findOneBy(['username' => 'admin']);
        $client->loginUser($adminUser);

        $client->request('GET', '/coaster/add'); 

        $this->assertResponseIsSuccessful();


        $client->submitForm('Ajouter', [
            'coaster[name]' => 'Test',
            'coaster[maxSpeed]' => 111,
            'coaster[maxHeight]' => 11,
            'coaster[lenght]' => 1111,
        ]);

        $this->assertResponseRedirects();

        $coasterRepository = static::getContainer()->get(CoasterRepository::class);
        $newCoaster = $coasterRepository->findOneBy(['name' => 'Test']);

        $this->assertEquals('Test', $newCoaster->getName());

    }
}