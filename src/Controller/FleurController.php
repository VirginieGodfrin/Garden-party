<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Fleur;
use App\Repository\FleurRepository;
use Symfony\Component\HttpFoundation\Request;
Use App\Form\FleurType;
use Doctrine\ORM\EntityManagerInterface;
/**
 * @Route("/fleur", name="fleur_")
 */
class FleurController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(FleurRepository $fleurRepo)
    {
    	// $fleurs = $fleurRepo->findAll();
        $fleurs = $fleurRepo->giveMeAllFlowers(); 
        // $fleurs = $fleurRepo->giveMeAllFleurSQL();
        
        return $this->render('fleur/index.html.twig', [
            'fleurs' => $fleurs,
        ]);
    }

    /**
     * @Route("/new/", name="new")
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {
    	$fleur = new Fleur;
        $form = $this->createForm(FleurType::class, $fleur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $fleur = $form->getData();

            $em->persist($fleur);
            
            $em->flush();

            return $this->redirectToRoute('fleur_index');
        }

        return $this->render('fleur/new.html.twig', [
            'form' => $form->createView(),
        ]); 
    }

    /**
     * @Route("/{slug}/edit/", name="edit")
     */
    public function editAction(Fleur $fleur, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(FleurType::class, $fleur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $fleur = $form->getData();

            $em->persist($fleur);
            
            $em->flush();

            return $this->redirectToRoute('fleur_index');
        }

        return $this->render('fleur/new.html.twig', [
            'form' => $form->createView(),
        ]); 
    }
}
