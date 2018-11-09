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
use App\Entity\Agent;
use Symfony\Component\HttpFoundation\Response;


/**
 * Agent controller.
 *
 * @Route("agent")
 */
class AgentController extends AbstractController
{


    /**
     *  Lists all agent entities.
     *
     * @Route("/show", name="agentShow")     *
     */
    public function ShowAction()
    {
        $em = $this->getDoctrine()->getManager();
        $agents = $em->getRepository('App:Agent')->findAll();


        return $this->render('agent/index.html.twig', [
            'agents' => $agents,
        ]);
    }

    /**
     * @Route("/create", name="agentCreate")
     */
    public function CreateAction()   {


        $agent = new Agent();
        $agent->setNni('E32979');
        $agent->setName('Dupont');
        $agent->setFirstName('Jean!');
        $agent->setFunction('chef d\'équipe');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($agent);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: '.$agent->getId()
        );
    }


}