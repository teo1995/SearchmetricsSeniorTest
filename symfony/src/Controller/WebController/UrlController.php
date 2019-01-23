<?php
/**
 * Created by PhpStorm.
 * User: Mateo
 * Date: 12.1.2019.
 * Time: 16:11
 */

namespace App\Controller\WebController;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UrlController extends Controller{
    /**
     * @Route("/")
     * @Method({"GET"})
     */
    public function index(){
        return $this->render('Urls/index.html.twig');
    }
}