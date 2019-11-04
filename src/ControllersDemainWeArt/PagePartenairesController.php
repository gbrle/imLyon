<?php

namespace App\ControllersDemainWeArt;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\DemainWeArt;
use App\Entity\SousCategorie;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\PartenaireRepository;
use Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle;
use Cocur\Slugify\Slugify;
use Cocur\Slugify\SlugifyInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class PagePartenairesController extends AbstractController
{
    /**
     * @Route("/partenaires", name="page_partenaires")
     */
    public function index(CategorieRepository $categorieRepo, PartenaireRepository $partenaireRepository)
    {



        // CATEGORIES
        $recordingStutios = $categorieRepo->findBy(['titre' => 'RECORDING STUDIOS']);
        $artistLabelServices = $categorieRepo->findBy(['titre' => 'ARTIST & LABEL SERVICES']);
        $training = $categorieRepo->findBy(['titre' => 'TRAINING']);
        $event = $categorieRepo->findBy(['titre' => 'EVENTS']);
        $partenaires = $partenaireRepository->findAll();




        return $this->render('demainWeArt/pagePartenaires.html.twig', [
            // CATERORIES
            'recordingStutios' => $recordingStutios[0],
            'artistLabelServices' => $artistLabelServices[0],
            'training' => $training[0],
            'event' => $event[0],
            'partenaires' => $partenaires,




        ]);
    }
}
