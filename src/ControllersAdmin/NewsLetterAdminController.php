<?php

namespace App\ControllersAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsLetterAdminController extends AbstractController
{
    /**
     * @Route("admin/newsletter", name="newsLetter_admin")
     */
    public function index()
    {

        $toto = "adad";

        return $this->render('admin/newsLetter.html.twig', [
            'toto' => $toto,
        ]);
    }
}
