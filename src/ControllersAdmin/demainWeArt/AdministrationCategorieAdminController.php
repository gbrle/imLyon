<?php

namespace App\ControllersAdmin\demainWeArt;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\DemainWeArt;
use App\Entity\SousCategorie;
use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationCategorieAdminController extends AbstractController
{



    /**
     * @Route("admin/demainWeArt/supprimerArticle/{id}", name="demainWeArt_administration_supprimer_article")
     */
    public function supprimerArticle(Article $article, EntityManagerInterface $manager, $id)
    {

        if($article->getPhoto()){
        unlink('uploads/'.$article->getPhoto().'');
        }
        $manager->remove($article);

        $manager->flush();

        $this->addFlash('message', 'L\'article" "' . $article->getTitre() . '" a bien été supprimée');

        return $this->redirectToRoute('demainWeArt_home');
    }

    /**
     * @Route("admin/demainWeArt/supprimerSousCategorie/{id}", name="demainWeArt_administration_supprimer_categorie")
     */
    public function supprimerSousCategorie(SousCategorie $sousCategorie, EntityManagerInterface $manager, $id)
    {

        $manager->remove($sousCategorie);

        $manager->flush();

        $this->addFlash('message', 'La sous-catégorie "' . $sousCategorie->getTitre() . '" a bien été supprimée');

        return $this->redirectToRoute('demainWeArt_home');
    }


    /**
     * @Route("admin/demainWeArt/administrationCatagorie/{titre}", name="demainWeArt_administration_categorie")
     */
    public function index(Categorie $categorie, Request $request, ObjectManager $manager, SlugifyInterface $slugify)
    {
        // Liste Sous-catégorie
        $listeSousCategories = $categorie->getSousCategorie();



        // Start Créer Form Sous Catégorie ----------------->
        $sousCategorie = new SousCategorie();

        $formSousCategorie = $this->createFormBuilder($sousCategorie)
                    ->add('titre')
                    ->add('format', ChoiceType::class, [
                        'choices' => [
                            'Sous forme de liste' => 'list',
                            'Sous forme de bulle' => 'bulle',
                            'Sous forme de formation' => 'formation',
                            'Sous forme de bannière' => 'banniere',
                        ]
                    ])
                    ->add('couleur', ChoiceType::class, [
                        'choices' => [
                            'Violet' => 'bgViolet',
                            'Rose' => 'bgRose',
                            'Gris' => 'bgGris',
                            'Violet Foncé' => 'bgVioletFonce',
                            'Marron' => 'bgMarron',
                            'Rose Claire' => 'bgRoseClaire',
                            'Beige' => 'bgBeige',
                            'Orange' => 'bgOrange',
                            'Jaune' => 'bgJaune',
                            'Rose pâle' => 'bgRosePale',
                            'Orange Pâle' => 'bgOrangePale',
                            'Rouge' => 'bgRouge',
                        ],
                        'choice_attr' => function($choice){
                            return [
                                'class' => $choice . ' Blanc',
                            ];
                        }
                    ])
                    ->getForm();

        $formSousCategorie->handleRequest($request);

        if($formSousCategorie->isSubmitted() && $formSousCategorie->isValid()){

            $sousCategorie->setSlugifyTitre($slugify->slugify($sousCategorie->getTitre()));
            $sousCategorie->setCategorie($categorie);
            $sousCategorie->setStatut(true);

            $manager->persist($sousCategorie);
            $manager->flush();

            $this->addFlash('message', 'La sous-catégorie "' . $sousCategorie->getTitre() . '" a bien été ajoutée');

            return $this->redirectToRoute('demainWeArt_home');

        }
        // End Créer Form Sous Catégorie ----------------->


        // Start Créer Form Texte Présentation ----------------->


        $formTextePresentation = $this->createFormBuilder($categorie)
            ->add('description')
            ->getForm();
        $formTextePresentation->handleRequest($request);
        if($formTextePresentation->isSubmitted() && $formTextePresentation->isValid()){
            $categorie->setDescription($categorie->getDescription());

            $manager->persist($categorie);
            $manager->flush();

            $this->addFlash('message', 'Le texte de présentation de la section "' . $categorie->getTitre() . '" a bien été modifié');

            return $this->redirectToRoute('demainWeArt_home');

        }
        // End Créer Form Texte Présentation ----------------->

        return $this->render('admin/pages/demainWeArt/administrationCategorie.html.twig', [
            'categorie' => $categorie,
            'formSousCategorie' => $formSousCategorie->createView(),
            'formTextePresentation' => $formTextePresentation->createView(),
            'listeSousCategories' => $listeSousCategories,

        ]);

    }
}
