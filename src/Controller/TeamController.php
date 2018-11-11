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
use App\Entity\Team;
use Symfony\Component\HttpFoundation\Response;


/**
 * team controller.
 *
 * @Route("team")
 */
class TeamController extends AbstractController
{


    /**
     *  Lists all team entities.
     *
     * @Route("/show", name="teamShow")     *
     */
    public function ShowAction()
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository('App:Team')->findAll();


        return $this->render('team/index.html.twig', [
            'teams' => $teams,
        ]);
    }

    /**
     * @Route("/create", name="teamCreate")
     */
    public function CreateAction()   {


        $team = new Team();        ;
        $team->setName('Vert');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($team);
        $entityManager->flush();

        return new Response(
            'Saved new team with id: '.$team->getId()
        );
    }


}