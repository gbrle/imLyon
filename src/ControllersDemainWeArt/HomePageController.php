<?php

namespace App\ControllersDemainWeArt;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class HomePageController extends AbstractController
{
    /**
     * @Route("/homeComming", name="homeComming")
     */
    public function homeComing()
    {


        return $this->render('demainWeArt/homeComing.html.twig');
    }


    /**
     * @Route("/", name="home_demainWeArt")
     */
    public function index(CategorieRepository $categorieRepository)
    {

        // CATEGORIES
        $recordingStutios = $categorieRepository->findBy(['titre' => 'RECORDING STUDIOS']);
        $artistLabelServices = $categorieRepository->findBy(['titre' => 'ARTIST & LABEL SERVICES']);
        $training = $categorieRepository->findBy(['titre' => 'TRAINING']);
        $event = $categorieRepository->findBy(['titre' => 'EVENTS']);



        return $this->render('demainWeArt/index.html.twig', [
            // CATERORIES
            'recordingStutios' => $recordingStutios[0],
            'artistLabelServices' => $artistLabelServices[0],
            'training' => $training[0],
            'event' => $event[0],
        ]);
    }
}
