<?php

namespace App\Controller;

use App\Entity\Pin;
use Doctrine\ORM\EntityManagerInterface;

use Repository\PinRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {

     if ($request->isMethod('POST')) {
         $data = $request->request->all();
         $Pin = new Pin;

         $Pin->setNom($data['nom']);
         $Pin->setPrenom($data['prenom']);
         $Pin->setTelephone($data['telephone']);
         $Pin->setMail($data['mail']);

          $Pin->setMarque($data['marque']);
         $Pin->setModele($data['modele']);

         $em->persist($Pin);
         $em->flush();

     }

        return $this->render('Pins/home.html.twig');
    }

     /**
     * @Route("/pins", name="pins")
     */

    public function home()
    {
        return $this->render('Pins/index.html.twig');
    }
}

