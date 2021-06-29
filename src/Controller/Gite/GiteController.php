<?php

namespace App\Controller\Gite;

use App\Entity\Gite;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\GiteSearch;
use App\Form\GiteSearchType;
use App\Repository\GiteRepository;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GiteController extends AbstractController
{
    private GiteRepository $repo;

    public function __construct(GiteRepository $repo)
    {
        $this->repo = $repo;
    }

    /** 
    * @Route("/", name="home")
    */
    public function index()
    {   
        $gites = $this->repo->findLastGite();
        return $this->render('home/index.html.twig', [
            'gites' => $gites
        ]);
    }


    /**
    * @Route("/gites", name="gite.index")
    */
    public function gites(Request $request)
    {
        // Créer une entité Recherche
        // Créer le formulaire associé
        // Gérer le traitement des données via SQL

        $search = new GiteSearch();
        $form = $this->createForm(GiteSearchType::class, $search);
        $form->handleRequest($request);

        $gites = $this->repo->findAllGiteSearch($search);
        
        return $this->render('gite/index.html.twig', [ 
            'gites' => $gites,
            'form' => $form->createView(),
        ]);
    }

    /**
    *@Route("/gite/{id}", name="gite.show")
    */ 
    public function show(Gite $gite, Request $request, ContactNotification $notification)
    {
        $contact = new Contact(); 
        $contact->setGite($gite);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact); 
            $this->addFlash('success', 'Votre email a bien été envoyé');
            return $this->redirectToRoute('gite.show', [
                'id' => $gite->getId(),
            ]);
        }

        return $this->render('gite/show.html.twig', [
            "gite" => $gite,
            "form" => $form->createView(), 
        ]);
    }
}