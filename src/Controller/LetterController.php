<?php
/**
 * Created by PhpStorm.
 * User: pellecuer
 * Date: 09/11/18
 * Time: 16:31
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Entity\Category;
use App\Entity\Letter;
use Symfony\Component\HttpFoundation\Response;


/**
 * Letter controller.
 *
 * @Route("letter")
 */
class LetterController extends AbstractController
{


    /**
     *  Lists all letter entities.
     *
     * @Route("/show", name="letterShow")     *
     */
    public function ShowAction()
    {
        $em = $this->getDoctrine()->getManager();
        $letters = $em->getRepository('App:Letter')->findAll();


        return $this->render('letter/index.html.twig', [
            'letters' => $letters,
        ]);
    }

    /**
     * @Route("/create", name="letterCreate")
     */
    public function CreateAction()   {


        $letter = new Letter();
        $letter->setLetter('R');
        $letter->setTimeRange(new \dateTime('11:00:00'));
        $letter->setStartHour(new \dateTime('7:00:00'));
        $letter->setEndHour(new \dateTime('19:00:00'));
        $letter->setEffectiveDuration(new \dateTime('10:00:00'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($letter);
        $entityManager->flush();

        return new Response(
            'Saved new letter with id: '.$letter->getId()
        );
    }


}