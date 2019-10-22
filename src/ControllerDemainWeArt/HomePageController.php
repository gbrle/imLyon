<?php

namespace App\ControllerDemainWeArt;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('demainWeArt/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }
}
