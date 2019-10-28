<?php

namespace App\ControllersAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageAdminController extends AbstractController
{
    /**
     * @Route("admin/home", name="home_page_admin")
     */
    public function index()
    {

        $toto = "adad";

        return $this->render('admin/home.html.twig', [
            'toto' => $toto,
        ]);
    }
}
