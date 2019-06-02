<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
Use App\Repository\LegumeRepository;

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
        
        return $this->render('legume/index.html.twig', [
            'legumes' => $legumes,
        ]);
    }
}
