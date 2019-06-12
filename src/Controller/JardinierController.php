<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JardinierRepository;

/**
 * @Route("/jardinier", name="jardinier_")
 */
class JardinierController extends AbstractController
{
    /**
 	 * @Route("/", name="index")
 	 */
    public function indexAction(JardinierRepository $jardinierRepo)
    {
    	$jardiniers = $jardinierRepo->giveMeAllJardinier();
    	$jardiniersFleur = $jardinierRepo->giveMeAllJardinierFleur('fleur');
    	$jardiniersArbre = $jardinierRepo->giveMeAllJardinierArbre('arbre');

        return $this->render('jardinier/index.html.twig', [
            'jardiniers' => $jardiniers,
            'jardiniersFleur' => $jardiniersFleur,
            'jardiniersArbre' => $jardiniersArbre

        ]);
    }

    
}
