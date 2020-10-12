<?php

namespace App\ControllersAdmin\demainWeArt;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\DemainWeArt;
use App\Entity\SousCategorie;
use App\Entity\Testimonial;
use App\Repository\CategorieRepository;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;

class CreerTestimonialController extends AbstractController
{
    /**
     * @Route("admin/demainWeArt/creerTestimonial", name="creer_Testimonial")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {

        // Start Créer Form Article ----------------->
        $testimonial = new Testimonial();

        $formTestimonial = $this->createFormBuilder($testimonial)
            ->add('titre')
            ->add('message')
            ->add('photo', FileType::class, [
                'label' => 'Image (100x100)',
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
            ->getForm();

        $formTestimonial->handleRequest($request);

        if($formTestimonial->isSubmitted() && $formTestimonial->isValid()){


            if($formTestimonial->get('photo')->getData() !== null){
            $file = $formTestimonial->get('photo')->getData();
            $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $testimonial->setPhoto($fileName);
            }


            $manager->persist($testimonial);
            $manager->flush();

            $this->addFlash('message', 'Avis bien ajouté');

            return $this->redirectToRoute('demainWeArt_home');

        }
        // End Créer Form Article ----------------->


        return $this->render('admin/pages/demainWeArt/CreerTestimonial.html.twig', [
            'formTestimonial' => $formTestimonial->createView(),
        ]);
    }
}
