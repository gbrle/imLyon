<?php

namespace App\ControllersAdmin\demainWeArt;

use App\Entity\Article;
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

class ModifierArticleAdminController extends AbstractController
{
    /**
     * @Route("admin/demainWeArt/modifierArticle/{id}", name="modifier_article")
     */
    public function index(Article $article, Request $request, ObjectManager $manager, SlugifyInterface $slugify)
    {

        $formArticle = $this->createFormBuilder($article)
            ->add('titre')
            ->add('descriptif')
            ->add('contenu', CKEditorType::class)
            ->getForm();

        $formArticle->handleRequest($request);

        if($formArticle->isSubmitted() && $formArticle->isValid()){

            $article->setSlugifyTitre($slugify->slugify($article->getTitre()));



            $manager->persist($article);
            $manager->flush();

            $this->addFlash('message', 'L\article a bien été modifié');

            return $this->redirectToRoute('demainWeArt_home');

        }

        return $this->render('admin/pages/demainWeArt/ModifierArticle.html.twig', [

            'formArticle' => $formArticle->createView(),
            'article' => $article
        ]);
    }
}
