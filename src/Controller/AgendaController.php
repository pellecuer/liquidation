<?php

namespace App\Controller;

use App\Entity\Agenda;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class AgendaController extends AbstractController
{
    /**
     *  Lists all agenda entities.
     *
     * @Route("/agenda", name="agenda")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $agendas = $em->getRepository('App:Agenda')->findAll();

        //mise en forme du tableau
        $agenda=[];
        for ($i = 0; $i < count($agendas); $i++) {
            $agenda[$i+1] = $agendas[$i]->getDate();
        }


        return $this->render('diary/index.html.twig', [
            'agenda' => $agenda,
        ]);
    }


    /**
     *  Lists all agenda entities.
     *
     * @Route("/agenda/team", name="agendaTeam")
     * @Method("GET")
     */
    public function indexTeamAction()
    {
        $startDate = new \DateTime('now - 200 days',  new \DateTimeZone('Europe/Paris'));
        $endDate = new \DateTime(('11-01-2019'));
        $agent = ['Jean', 'Jules', 'Paul'];

        $dateBetweens = $this->getDoctrine()
            ->getRepository(Agenda::class)
            ->findDateBetweenDate($startDate, $endDate);

        For ($i=0; $i<count($agent); $i++){
        $agentBetweens[] = $this->getDoctrine()
            ->getRepository(Agenda::class)
            ->findAgentBetweenDate($startDate, $endDate, $agent[$i]);
        }



        return $this->render('agenda/index.html.twig', [
            'dateBetweens' => $dateBetweens,
            'agentBetweens' => $agentBetweens
        ]);
    }
}
