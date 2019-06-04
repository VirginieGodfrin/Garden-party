<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Fleur;
use App\Repository\FleurRepository;

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
        return $this->render('fleur/index.html.twig', [
            'fleurs' => $fleurs,
        ]);
    }

    /**
     * @Route("/new/", name="new")
     */
    public function newAction(FleurRepository $fleurRepo)
    {
    	
    }
}
