<?php

namespace App\ControllersDemainWeArt;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class PageCategorieController extends AbstractController
{
    /**
     * @Route("/page_categorie/{titre}", name="page_categorie")
     */
    public function index(CategorieRepository $categorieRepository, SousCategorie $sousCategorie)
    {

        $articles = $sousCategorie->getArticle();


        // CATEGORIES
        $recordingStutios = $categorieRepository->findBy(['titre' => 'RECORDING STUDIOS']);
        $artistLabelServices = $categorieRepository->findBy(['titre' => 'ARTIST & LABEL SERVICES']);
        $training = $categorieRepository->findBy(['titre' => 'TRAINING']);
        $event = $categorieRepository->findBy(['titre' => 'EVENTS']);
        $partenaire = $categorieRepository->findBy(['titre' => 'PARTENAIRES']);



        return $this->render('demainWeArt/pageCategorie.html.twig', [
            // CATERORIES
            'recordingStutios' => $recordingStutios[0],
            'artistLabelServices' => $artistLabelServices[0],
            'training' => $training[0],
            'event' => $event[0],
            'partenaire' => $partenaire[0],

            'articles' => $articles,
            'sousCategorie' => $sousCategorie,

            // Articles
        ]);
    }
}
