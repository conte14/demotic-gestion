<?php

namespace App\Controller;


use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PinRepository $repo): Response
    {
        return $this->render('Pins/index.html.twig',['Pins'=>$repo->findAll()]);
    }

   

     /**
    * @Route("/pins/show", name="app_pins_show")
     */
    public function show(): Response
    {
        return $this->render('Pins/show.html.twig');
    }










      /**
     * @Route("/pins", name="app_create")
     */
    public function create(Request $request,EntityManagerInterface $em ): Response
    {
       $form = $this->createFormBuilder()
        ->add('nom', TextType::class)
        ->add('prenom', TextType::class)
        ->add('telephone',  NumberType::class)
        ->add('mail', EmailType::class)
        ->add('marque', TextType::class)
        ->add('modele', TextType::class)
        ->add('valider', SubmitType::class)
         ->getForm()
    ;



       //gerer le formulaire pour eviter les petit probleme
       $form->handleRequest($request);
        if ($form->isSubmitted () && $form->isValid()) {


            $data = $form->getData();

            $Pin = new Pin;
            $Pin->setPrenom ($data['prenom']);
            $Pin->setNom($data['nom']);
            $Pin->setTelephone ($data['telephone']);
            $Pin->setMail ($data['mail']);
            $Pin->setMarque($data['marque']);
            $Pin->setModele($data['modele']);

            $em->persist($Pin);
            $em->flush();


      return $this->redirectToRoute('app_home');
    
           
        }



        return $this->render('Pins/create.html.twig', [
            'monFormulaire'=>$form->createView()
            ]);
    
        }
        
    }