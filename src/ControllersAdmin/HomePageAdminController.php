<?php

namespace App\ControllersAdmin;

use App\Entity\Newsletter;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
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
    public function postNewsletter(Request $request, ObjectManager $em)
    {
        try{
        $subscript = new Newsletter();

        $subscript->setMail($request->getContent());
        $subscript->setIp($request->getClientIp());

        $em->persist($subscript);
        $em->flush();

        $message = "L'inscription a bien été prise en compte";

            return $this->json($message);

        } catch (\Exception $e){

            $message = "Vous êtes déjà inscrit(e)";

            return $this->json($message);
        }
    }
}
