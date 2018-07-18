<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 16/07/18
 * Time: 11:52
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class FrontController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */

    public function homeAction()
    {


        return $this->render ('Front/index.html.twig');
    }
}