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
     *  Lists all agenda entities.
     *
     * @Route("/agenda/team", name="agendaTeam")
     * @Method({"POST", "GET"})
     */
    public function indexTeamAction(Request $request)
    {
        $startDate = new \DateTime('now - 200 days',  new \DateTimeZone('Europe/Paris'));
        $endDate = new \DateTime(('11-01-2019'));
        $agent = ['Jean', 'Jules', 'Paul', 'Christelle'];

        //create the form
        $form = $this->createForm(AgendaType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $startDate = $data['startDate'];
            $endDate = $data['endDate'];

            For ($i=0; $i<count($agent); $i++){
                $agentBetweens[] = $this->getDoctrine()
                    ->getRepository(Agenda::class)
                    ->findAgentBetweenDate($startDate, $endDate, $agent[$i]);
            }

            $diff=$startDate->diff($endDate)->days;
            $diff1Day = new \DateInterval('P1D');
            $arrayDate = [];


            for ($i=0;$i<$diff;$i++){
                $arrayDate[] =  $startDate;
                $startDate = $startDate->add($diff1Day);
            }

            return $this->render('agenda/index.html.twig', [
                'dateBetweens' => $arrayDate,
                'agentBetweens' => $agentBetweens,
                'form' => $form->createView()
            ]);


        } else {




            For ($i=0; $i<count($agent); $i++){
            $agentBetweens[] = $this->getDoctrine()
                ->getRepository(Agenda::class)
                ->findAgentBetweenDate($startDate, $endDate, $agent[$i]);
            }

            $startDate = new \DateTimeImmutable('now - 3 days',  new \DateTimeZone('Europe/Paris'));
            $endDate = new \DateTime('now + 2 day',  new \DateTimeZone('Europe/Paris'));

            $diff=$startDate->diff($endDate)->days;
            $diff1Day = new \DateInterval('P1D');
            $arrayDate = [];


            for ($i=0;$i<$diff;$i++){
                $arrayDate[] =  $startDate;
                $startDate = $startDate->add($diff1Day);
            }



            return $this->render('agenda/index.html.twig', [
                'dateBetweens' => $arrayDate,
                'agentBetweens' => $agentBetweens,
                'form' => $form->createView()
            ]);
        }
    }
}
