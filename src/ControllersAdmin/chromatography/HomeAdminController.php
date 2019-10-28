<?php

namespace App\ControllersAdmin\chromatography;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeAdminController extends AbstractController
{
    /**
     * @Route("admin/chromatography/home", name="chromatography_home")
     */
    public function index()
    {

        $toto = "adad";

        return $this->render('admin/pages/chromatography/home.html.twig', [
            'toto' => $toto,
        ]);
    }
}
