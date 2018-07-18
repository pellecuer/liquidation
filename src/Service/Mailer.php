<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 17/07/18
 * Time: 23:36
 */

namespace App\Service;

use  App\Entity\User;


class Mailer
{
    protected $mailer;

        public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendMail($subject, $to, $from, $body)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body,
        'text/html'
            );

            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */

        $this->mailer->send($message);
    }

    public function sendRegistrationMail(User $user)
    {
        $to = $user->getEmail();
        $from = 'support@liquidationavanttravaux.com';
        $subject = 'Votre compte utilisateur a été crée. Vous pouvez désormais vous connecter avec vos identifiants';
        $body = $this->templating->render('emails/registration.html.twig', array(
            'nickname' => $user->getNickName()
        ));


        $this->sendmail($subject, $to, $from, $body);

    }
}