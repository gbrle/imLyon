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


class PageArticleController extends AbstractController
{
    /**
     * @Route("demainweart/article/{slugifyTitre}", name="demainweart_page_article")
     */
    public function index(CategorieRepository $categorieRepository, Article $article)
    {

        $couleurFooter = $article->getSousCategorie()->getCategorie()->getCouleurFooter();
        $background = $article->getSousCategorie()->getCategorie()->getBackgroundImage();
        $backgroundColor = $article->getSousCategorie()->getCouleur();


        // CATEGORIES
        $recordingStutios = $categorieRepository->findBy(['titre' => 'RECORDING STUDIOS']);
        $artistLabelServices = $categorieRepository->findBy(['titre' => 'ARTIST & LABEL SERVICES']);
        $training = $categorieRepository->findBy(['titre' => 'TRAINING']);
        $event = $categorieRepository->findBy(['titre' => 'EVENTS']);



        return $this->render('demainWeArt/pageArticle.html.twig', [
            // CATERORIES
            'recordingStutios' => $recordingStutios[0],
            'artistLabelServices' => $artistLabelServices[0],
            'training' => $training[0],
            'event' => $event[0],


            'article' => $article,
            'couleurFooter' => $couleurFooter,
            'background' => $background,
            'backgroundColor' => $backgroundColor,
            // Articles

        ]);
    }
}
