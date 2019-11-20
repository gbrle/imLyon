<?php

namespace App\ControllersAdmin;

use App\Repository\NewsletterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsLetterAdminController extends AbstractController
{
    /**
     * @Route("admin/newsletter", name="newsLetter_admin")
     */
    public function index(NewsletterRepository $newsletterRepository)
    {

        $nbBreInscrit = $newsletterRepository->findAll();

        return $this->render('admin/newsLetter.html.twig', [
            'nbBreInscrit' => $nbBreInscrit,
        ]);
    }
}
