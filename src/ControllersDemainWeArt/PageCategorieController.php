<?php

namespace App\ControllersDemainWeArt;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle;
use Cocur\Slugify\Slugify;
use Cocur\Slugify\SlugifyInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class PageCategorieController extends AbstractController
{
    /**
     * @Route("demainweart/categorie/{slugifyTitre}", name="demainweart_page_categorie")
     */
    public function index(CategorieRepository $categorieRepository, SousCategorie $sousCategorie)
    {

        $articles = $sousCategorie->getArticle();
        $couleurFooter = $sousCategorie->getCategorie()->getCouleurFooter();
        $background = $sousCategorie->getCategorie()->getBackgroundImage();


        // CATEGORIES
        $recordingStutios = $categorieRepository->findBy(['titre' => 'RECORDING STUDIOS']);
        $artistLabelServices = $categorieRepository->findBy(['titre' => 'ARTIST & LABEL SERVICES']);
        $training = $categorieRepository->findBy(['titre' => 'TRAINING']);
        $event = $categorieRepository->findBy(['titre' => 'EVENTS']);



        return $this->render('demainWeArt/pageCategorie.html.twig', [
            // CATERORIES
            'recordingStutios' => $recordingStutios[0],
            'artistLabelServices' => $artistLabelServices[0],
            'training' => $training[0],
            'event' => $event[0],

            'articles' => $articles,
            'sousCategorie' => $sousCategorie,
            'couleurFooter' => $couleurFooter,
            'background' => $background,
            // Articles

        ]);
    }
}
