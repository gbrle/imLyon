<?php

namespace App\ControllersAdmin\demainWeArt;

use App\Entity\DemainWeArt;
use App\Entity\SousCategorie;
use App\Repository\CategorieRepository;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ModifierSousCategorieAdminController extends AbstractController
{
    /**
     * @Route("admin/demainWeArt/modifierSousCategorie/{id}", name="modifier_sous_categorie")
     */
    public function index(SousCategorie $sousCategorie, Request $request, ObjectManager $manager, SlugifyInterface $slugify)
    {

        $formSousCategorie = $this->createFormBuilder($sousCategorie)
            ->add('titre')
            ->add('format', ChoiceType::class, [
                'choices' => [
                    'Sous forme de liste' => 'list',
                    'Sous forme de bulle' => 'bulle',
                    'Sous forme de formation' => 'formation',
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



            $manager->persist($sousCategorie);
            $manager->flush();

            $this->addFlash('message', 'La sous-catégorie "' . $sousCategorie->getTitre() . '" a bien été modifiée');

            return $this->redirectToRoute('demainWeArt_home');

        }

        return $this->render('admin/pages/demainWeArt/ModifierSousCategorie.html.twig', [
            'formSousCategorie' => $formSousCategorie->createView(),
            'sousCategorie' => $sousCategorie,
        ]);
    }
}
