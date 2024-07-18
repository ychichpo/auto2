<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AuthAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Faker\Factory;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $faker = Factory::create();

        $user->setSexe(0);
        $user->setNom($faker->lastName);
        $user->setPrenom($faker->firstName);
        $user->setAdresse($faker->address);
        $user->setBirthdayDate($faker->dateTimeThisCentury);

        $formattedNumber = str_replace('-', '', $faker->phoneNumber);

        //$user->setPhone((int) $formattedNumber);


        $user->setPostalCode($faker->postcode);
        $user->setCity($faker->city);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $role = $form->get('type_compte')->getData();
            //dd($role);
            if ($role === 'eleve') {
                $user->setRoles(['ROLE_ELEVE']);
            } elseif ($role === 'moniteur') {
                $user->setRoles(['ROLE_MONITEUR']);
            }
           // $user->set

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $security->login($user, AuthAuthenticator::class, 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
