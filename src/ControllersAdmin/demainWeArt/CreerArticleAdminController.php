<?php

namespace App\ControllersAdmin\demainWeArt;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\DemainWeArt;
use App\Entity\SousCategorie;
use App\Repository\CategorieRepository;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreerArticleAdminController extends AbstractController
{
    /**
     * @Route("admin/demainWeArt/creerArticle/{id}", name="creer_article")
     */
    public function index(SousCategorie $sousCategorie, Request $request, ObjectManager $manager, SlugifyInterface $slugify)
    {

        // Start Créer Form Article ----------------->
        $article = new Article();

        $formArticle = $this->createFormBuilder($article)
            ->add('titre')
            ->add('descriptif')
            ->add('contenu', CKEditorType::class)
            ->getForm();

        $formArticle->handleRequest($request);

        if($formArticle->isSubmitted() && $formArticle->isValid()){

            $article->setSlugifyTitre($slugify->slugify($article->getTitre()));
            $article->setSousCategorie($sousCategorie);


            $manager->persist($article);
            $manager->flush();

            $this->addFlash('message', 'L\article a bien été ajoutée');

            return $this->redirectToRoute('demainWeArt_home');

        }
        // End Créer Form Article ----------------->


        return $this->render('admin/pages/demainWeArt/CreerArticle.html.twig', [
            'formArticle' => $formArticle->createView(),
            'sousCategorie' => $sousCategorie
        ]);
    }
}
