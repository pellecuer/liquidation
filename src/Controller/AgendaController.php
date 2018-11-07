<?php

namespace App\Controller;

use App\Entity\Agenda;
use App\Form\AgendaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;



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
     * @Method({"POST", "GET"})
     */
    public function indexTeamAction(Request $request)
    {

        //$startDate = new \DateTime('now - 200 days',  new \DateTimeZone('Europe/Paris'));
        //$endDate = new \DateTime(('11-01-2019'));


        //create the form
        $form = $this->createFormBuilder()
            ->add('startDate', DateType::class, array(
                'placeholder' => 'Choose a delivery option',
                'constraints' => array(
                    new NotBlank()
                ),
                'widget' => 'single_text',
                'label'  => 'Date de début',
                'attr' => array('class' => 'form-group mb-2'),
            ))

            ->add('endDate', DateType::class, array(
                'placeholder' => 'Choose a delivery option',
                'constraints' => array(
                    new NotBlank()
                ),
                'widget' => 'single_text',
                'label'  => 'Date de fin',
                'attr' => array('class' => 'form-group mx-sm-3 mb-2'),
            ))

            ->add('Envoyer', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-primary mb-2 sendDate'),
            ))

            ->getForm()
        ;

        //get date from Form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $startDate = $data['startDate'];
            $endDate = $data['endDate'];
            //dump($startDate);die;

        } else {

            $startDate = new \DateTime('now - 1000 days',  new \DateTimeZone('Europe/Paris'));
            $endDate = new \DateTime('now + 2 day',  new \DateTimeZone('Europe/Paris'));
        }

        //dump($startDate);die;

        //build letterArray
        $agent = ['Jean', 'Jules', 'Paul', 'Christelle'];
        $agentBetweens = [];
        For ($i=0; $i<count($agent); $i++){
            $agentBetweens[] = $this->getDoctrine()
                ->getRepository(Agenda::class)
                ->findAgentBetweenDate($startDate, $endDate, $agent[$i]);
        }
        //dump($agentBetweens);die;

        //build dateArray
        $diff=$startDate->diff($endDate)->format("%a");
        $interval = new \DateInterval('P1D');
        $arrayDate = [];

        $immutable = \DateTimeImmutable::createFromMutable($startDate);


        for ($i=0;$i<$diff;$i++){
            $arrayDate[] = $immutable ;
            $immutable = $immutable->add($interval);
        }


        return $this->render('agenda/index.html.twig', [
            'dateBetweens' => $arrayDate,
            'agentBetweens' => $agentBetweens,
            'form' => $form->createView(),
        ]);

    }
}
