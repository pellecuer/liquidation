<?php

namespace App\Controller;

use App\Entity\Agenda;
use App\Entity\Team;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Agenda controller.
 *
 * @Route("agenda")
 */
class AgendaController extends AbstractController
{
    /**
     *
     * @Route("/", name="agenda")
     */
    public function indexAction()
    {
        $team = new Team();
        $team->setName('bleu');

        $agenda = new Agenda();
        $agenda->setDate(\DateTime::createFromFormat('Y-m-d', "2020-01-01"));
        $agenda->setAgent('Jean');
        $agenda->setLetter('J');

        // relates this product to the category
        $agenda->setTeam($team);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($team);
        $entityManager->persist($agenda);
        $entityManager->flush();

        return new Response(
            'Saved new agenda with id: '.$agenda->getId()
            .' and new team with id: '.$team->getId()
        );
    }



    public function show($id)
    {
        $agenda = $this->getDoctrine()
            ->getRepository(Agenda::class)
            ->find($id);

        // ...

        $teamName = $agenda->getTeam()->getName();

        // ...
    }





    /**
     *  Lists all agenda entities by Date.
     *
     * @Route("/show", name="agendaShow")
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

            $startDate = new \DateTime('01-02-2016',  new \DateTimeZone('Europe/Paris'));
            $endDate = new \DateTime('02-02-2020',  new \DateTimeZone('Europe/Paris'));
            //dump($startDate);die;
        }

        //dump($startDate);die;

        //build letterArray
        $agentId = [1, 2, 3];
        $agentBetweens = [];
        For ($i=0; $i<count($agentId); $i++){
            $agentBetweens[] = $this->getDoctrine()
                ->getRepository(Agenda::class)
                ->findAllBetweenDate($startDate, $endDate, $agentId[$i]);
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
