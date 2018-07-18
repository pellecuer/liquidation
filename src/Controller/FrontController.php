<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 16/07/18
 * Time: 11:52
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Mailer;
use App\Form\LostPasswordType;
use App\Form\ResetPasswordType;
use App\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class FrontController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function homeAction()
    {
        return $this->render ('Front/index.html.twig');
    }


    /**
     * @Route("/lostpassword", name="lostPassword")     *
     */
    public function lostPasswordAction(Request $request, Mailer $mailer)
    {
        $form=$this->createForm(LostPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $email = $data['email'];
            $userPasswordLost = $this->getDoctrine()
                ->getRepository(User:: class)
                ->findOneBy([
                    'email' => $email
                ]);

            if ($userPasswordLost) {
                $token = uniqid();
                $userPasswordLost->setToken($token);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $url = $this->generateUrl('resetPassword', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

                $mailer->sendLostPasswordMail($userPasswordLost, $url);
                $this->addFlash('success', 'Consultez votre boite mail. Un message vous a été envoyé avec un lien pour réinitialiser votre mot de passe  ');
                return $this->redirectToRoute('home');

            } else {
                $this->addFlash('danger', 'Nous n\'avons pas trouvé d\'utilisateur avec cet email. Merci de rééssayer');

                return $this->redirectToRoute('lostPassword');
            }
        }
            return $this->render('Front/lostPassword.html.twig', array(
                'form'=>$form->createView()
            ));
    }


    /**
     * @Route("/resetpassword/{token}", name="resetPassword")
     * @Method({"GET", "POST"})
     */
    public function resetPasswordAction(Request $request, UserPasswordEncoderInterface $encoder, $token)
    {
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $plainPassword = $data['newPassword'];
            $user = $this->getDoctrine()
                ->getRepository(User:: class)
                ->findOneBy([
                    'token' => $token
                ]);
            if ($user) {
                $encoded = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encoded);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                $this->addFlash('success', 'Votre mot de passe a été mis à jour');
                return $this->redirectToRoute('home');
            } else {
                $this->addFlash('danger', 'la réinitialisation de votre mot de passe a échoué, veuillez renouveler votre demande');

                return $this->redirectToRoute('lostPassword');
            }
        }
        return $this->render('Front/resetPassword.html.twig', array(
            'form'=>$form->createView()
        ));
    }


}