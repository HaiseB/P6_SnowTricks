<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserForgotPasswordFormType;
use App\Form\UserNewPasswordFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Form\UserRegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
 * @Route("/register", name="app_register")
 */
    public function register(MailerInterface $mailer, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $token = bin2hex(random_bytes(60));
            $user->setToken($token);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from(new Address('support@snowtricks.com', 'Snowtricks'))
                ->to(new Address($user->getEmail(), $user->getUsername()))
                ->subject('Bienvenue sur Snowtricks!')
                ->htmlTemplate('email/register.html.twig')
                ->context([
                    'user' => $user
                ]);

            $mailer->send($email);
            //@TODO add flash message

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render(
            'security/register.html.twig',
            array('userForm' => $form->createView())
        );
    }

    /**
     * @Route("/confirm_register/{id}/{token}", name="app_confirm_register")
     */
    public function confirm_register(EntityManagerInterface $em, User $user)
    {
        $user->setIsRegistered(true);

        $em->persist($user);
        $em->flush();
        //@TODO add flash message

        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/forgot_password", name="app_forgot_password")
     */
    public function forgot_password(MailerInterface $mailer, UserRepository $userRepository, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(UserForgotPasswordFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $email = $form->get('email')->getData();

            $user = $userRepository->findOneByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(60));
                $user->setToken($token);
                $user->setAskedResetPassword(true);

                $em->persist($user);
                $em->flush();

                $email = (new TemplatedEmail())
                    ->from(new Address('support@snowtricks.com', 'Snowtricks'))
                    ->to(new Address($user->getEmail(), $user->getUsername()))
                    ->subject('Demande de réinitialisation de mot de passe')
                    ->htmlTemplate('email/forgot_password.html.twig')
                    ->context([
                        'user' => $user
                    ]);

                $mailer->send($email);
            }

            //@TODO add flash message
            return $this->redirectToRoute('app_login');
        }

        return $this->render(
            'security/forgotPassword.html.twig', [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/change_password/{id}/{token}", name="app_change_password")
     */
    public function change_password(EntityManagerInterface $em, User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($user->getAskedResetPassword() === true) {
            $form = $this->createForm(UserNewPasswordFormType::class );

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var User $user */
                $password = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
                $user->setPassword($password);
                $user->setAskedResetPassword(false);

                $em->persist($user);
                $em->flush();

                //@TODO add flash message
                return $this->redirectToRoute('app_login');
            }

            return $this->render(
                'security/newPassword.html.twig', [
                    'form' => $form->createView(),
                    'user' => $user
                ]
            );
        }

        //@TODO add flash message
        return $this->redirectToRoute('app_login');
    }
}
