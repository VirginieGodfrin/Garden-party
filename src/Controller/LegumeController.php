<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
Use App\Repository\LegumeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Legume;
Use App\Form\LegumeType;

/**
 * @Route("/legume", name="legume_")
 */
class LegumeController extends AbstractController
{
	/**
	 * @Route("/", name="index")
	 */
    public function indexAction(LegumeRepository $legumeRepo)
    {	
    	$legumes = $legumeRepo->findAll();
        $legumesEscargots = $legumeRepo->findByfleurNom('Escargots');
        // dump($legumesEscargots);
        return $this->render('legume/index.html.twig', [
            'legumes' => $legumes,
            'legumesEscargots' => $legumesEscargots
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {   
        $legume = new Legume;
        $form = $this->createForm(legumeType::class, $legume);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $legume = $form->getData();

            $em->persist($legume);
            
            $em->flush();

            return $this->redirectToRoute('legume_index');
        }

        return $this->render('legume/form.html.twig', [
            'form' => $form->createView(),
        ]); 
    }

    /**
     * @Route("/{slug}/edit", name="edit")
     */
    public function editAction(Request $request, EntityManagerInterface $em, Legume $legume)
    {   

        $form = $this->createForm(legumeType::class, $legume);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $legume = $form->getData();
             // dump($legume);die;

            $em->flush();

            return $this->redirectToRoute('legume_index');
        }

        return $this->render('legume/form.html.twig', [
            'form' => $form->createView(),
        ]); 
    }

   
}
