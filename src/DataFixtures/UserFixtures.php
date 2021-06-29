<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)    
	{
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
	        ->setUsername('admin')
		    ->setRoles(['ROLE_ADMIN'])
		    ->setPassword($this->encoder->hashPassword($user, 'admin'))
		    ->setAge(25);
            
        $user2 = new User();
        $user2
            ->setUsername('user')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->encoder->hashPassword($user, 'user'))
            ->setAge(40);
                       
        $manager->persist($user); 
        $manager->persist($user2);    

        $manager->flush();
    }
}
