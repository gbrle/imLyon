<?php

namespace App\ControllersAdmin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomePageAdminController extends AbstractController
{
    /**
     * @Route("admin/home", name="home_page_admin")
     */
    public function index()
    {



        return $this->render('admin/home.html.twig', [

        ]);
    }

    /**
     * @Route("postNewsletter", name="postNewsletter")
     */
    public function postNewsletter(Request $request)
    {

        dd($request->getContent());

        return $this->json('ok');
    }
}
