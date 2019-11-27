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


class PagePolitiqueConfidentialiteController extends AbstractController
{
    /**
     * @Route("demainweart/politiqueConfidentialite", name="demainweart_page_politique_confidentialite")
     */
    public function index(CategorieRepository $categorieRepo)
    {



        // CATEGORIES
        $recordingStutios = $categorieRepo->findBy(['titre' => 'RECORDING STUDIOS']);
        $artistLabelServices = $categorieRepo->findBy(['titre' => 'ARTIST & LABEL SERVICES']);
        $training = $categorieRepo->findBy(['titre' => 'TRAINING']);
        $event = $categorieRepo->findBy(['titre' => 'EVENTS']);




        return $this->render('demainWeArt/pagePolitiqueConfidentialite.html.twig', [
            // CATERORIES
            'recordingStutios' => $recordingStutios[0],
            'artistLabelServices' => $artistLabelServices[0],
            'training' => $training[0],
            'event' => $event[0],




        ]);
    }
}
