<?php
/**
 * Created by PhpStorm.
 * User: pellecuer
 * Date: 25/10/18
 * Time: 19:27
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AjaxController
{
    /**
     * @Route(" /ajax_request", name=" /ajax_request")
     */
    public function ajaxAction(Request $request)
    {
        /* on récupère la valeur envoyée par la vue */
        $personnage = strtoupper($request->request->get('personnage'));
        switch ($personnage){
            case 'H':
                $titre = 'Repos hebdo';
                $producteur = '35h minimum';
                break;
            case 'J':
                $titre = 'Journée de travail normal';
                $producteur = '7h45-16h30';
                break;
            case 'M':
                $titre = 'Horaire M';
                $producteur = '5h-13h';
                break;
            case 'D':
                $titre = '5h30';
                $producteur = '15h30';
                break;
            case 'R':
                $titre = 'Repos journalier';
                $producteur = '11h minimum';
        }

        /* la réponse doit être encodée en JSON ou XML, on choisira le JSON
         * la doc de Symfony est bien faite si vous devez renvoyer un objet         *
         */
        $response = new Response(json_encode(array(
            'titre' => $titre,
            'producteur' => $producteur
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}