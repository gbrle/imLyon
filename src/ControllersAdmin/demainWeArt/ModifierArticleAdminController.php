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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('photo', FileType::class, [
                'data_class' => null,
                'by_reference' => false,
                'label' => 'Image de bulle (Reste vide si aucune)',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Le fichier est invalide',
                    ])
                ],

            ])
            ->add('contenu', CKEditorType::class)
            ->getForm();

        $ancienFichier = $formArticle->get('photo')->getData();
        $formArticle->handleRequest($request);

        if($formArticle->isSubmitted() && $formArticle->isValid()){

            $nouveauFichier = $formArticle->get('photo')->getData();

            $article->setSlugifyTitre($slugify->slugify($article->getTitre()));

            if($ancienFichier == null && $nouveauFichier !== null)
            {
                $file = $nouveauFichier;
                $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $article->setPhoto($fileName);
            }
            else if($ancienFichier !== null && $nouveauFichier == null)
            {

                $article->setPhoto($ancienFichier);
            }
            else if ($nouveauFichier !== $ancienFichier && $nouveauFichier !== null)
                {
                    unlink('uploads/'.$ancienFichier);
                    $file = $nouveauFichier;
                    $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();
                    $file->move($this->getParameter('upload_directory'), $fileName);
                    $article->setPhoto($fileName);
                }

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

    /**
     * @Route("admin/demainWeArt/statutArticle/{id}", name="statut_article")
     */
    public function statutArticle(Article $article, ObjectManager $manager)
    {

        if($article->getStatut() === false){
            $article->setStatut(true);



            $manager->persist($article);
            $manager->flush();

            $this->addFlash('message', 'L\'article "' . $article->getTitre() . '" est activée');
        } else {
            $article->setStatut(false);



            $manager->persist($article);
            $manager->flush();

            $this->addFlash('message', 'L\'article "' . $article->getTitre() . '" est désactivée');
        }

        return $this->redirectToRoute('demainWeArt_home');

    }
}
