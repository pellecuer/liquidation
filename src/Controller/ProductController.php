<?php
/**
 * Created by PhpStorm.
 * User: pellecuer
 * Date: 24/10/18
 * Time: 19:09
 */

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Product;


/**
* Productcontroller.
 *
 * @Route("product", name="product")
*/
class ProductController extends AbstractController
{
    /**
     * Lists all products entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('App:Product')->findAll();
        return $this->render('Products/index.html.twig', array(
            'products' => $products,
        ));
    }

}