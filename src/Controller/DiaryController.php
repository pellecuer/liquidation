<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class DiaryController extends AbstractController
{
    /**
     *  Lists all products entities.
     *
     * @Route("/diary", name="diary")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $diaries = $em->getRepository('App:Diary')->findAll();

        //mise en forme du tableau
        $diarie=[];
        for ($i = 0; $i < count($diaries); $i++) {
            $diarie[$i+1] = $diaries[$i]->getDate();
        }


        return $this->render('diary/index.html.twig', [
            'diaries' => $diarie,
        ]);
    }
}
