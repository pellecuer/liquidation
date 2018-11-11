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
use App\Entity\Role;
use Symfony\Component\HttpFoundation\Response;


/**
 * role controller.
 *
 * @Route("role")
 */
class RoleController extends AbstractController
{


    /**
     *  Lists all role entities.
     *
     * @Route("/show", name="roleShow")     *
     */
    public function ShowAction()
    {
        $em = $this->getDoctrine()->getManager();
        $roles = $em->getRepository('App:Role')->findAll();


        return $this->render('role/index.html.twig', [
            'roles' => $roles,
        ]);
    }

    /**
     * @Route("/create", name="roleCreate")
     */
    public function CreateAction()   {


        $role = new Role();        ;
        $role->setName('agent');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($role);
        $entityManager->flush();

        return new Response(
            'Saved new role with id: '.$role->getId()
        );
    }


}