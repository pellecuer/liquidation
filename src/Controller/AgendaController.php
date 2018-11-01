<?php

namespace App\Controller;

use App\Entity\Agenda;
use App\Form\AgendaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


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
     *  Lists all agenda entities by Date.
     *
     * @Route("/agenda/team", name="agendaTeam")
     * @Method("GET")
     */
    public function indexTeamAction(Request $request)
    {
        //row date
        //$startDate = new \DateTimeImmutable('now',  new \DateTimeZone('Europe/Paris'));
        //$endDate = new \DateTime('now + 5 days',  new \DateTimeZone('Europe/Paris'));


        // Ajax Date
        $startDateAjax = strtoupper($request->request->get('startDate'));
        $endDateAjax = strtoupper($request->request->get('endDate'));
        var_dump($endDateAjax);
        $startDate = new \DateTimeImmutable($startDateAjax,  new \DateTimeZone('Europe/Paris'));
        $endDate = new \DateTime($endDateAjax,  new \DateTimeZone('Europe/Paris'));




        $diff=$startDate->diff($endDate)->days;
        $diff1Day = new \DateInterval('P1D');
        $arrayDate = [];


        for ($i=0;$i<$diff;$i++){
            $arrayDate[] =  $startDate;
             $startDate = $startDate->add($diff1Day);
        }

        //row team
        $team = ['Jean', 'Paul'];

        for ($i =0; $i<count($team); $i++){

        $agentBetweens[$i] = $this->getDoctrine()
            ->getRepository(Agenda::class)
            ->findAgentBetweenDate($startDate, $endDate, $team[0]);

        }


        return $this->render('agenda/index.html.twig', [
            'dateBetweens' => $arrayDate,
            'agentBetweens' => $agentBetweens,
            'rowNumber' => $i,
        ]);
    }
}
