<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MangeurRepository;

/**
 * @Route("/mangeur", name="mangeur_")
 */
class MangeurController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(MangeurRepository $mangeurRepo)
    {
    	// $mangeurs = $mangeurRepo->giveMeAllMangeurs();
        $mangeurs = $mangeurRepo->findAll();
    	dump($mangeurs);
        return $this->render('mangeur/index.html.twig', [
            'mangeurs' => $mangeurs,
        ]);
    }
}
