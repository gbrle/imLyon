<?php

namespace App\ControllersAdmin\demainWeArt;

use App\Entity\DemainWeArt;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeAdminController extends AbstractController
{
    /**
     * @Route("admin/demainWeArt/home", name="demainWeArt_home")
     */
    public function index(CategorieRepository $categorieRepository)
    {

        $categories = $categorieRepository->findAll();

        return $this->render('admin/pages/demainWeArt/home.html.twig', [
            'categories' => $categories,
        ]);
    }
}
