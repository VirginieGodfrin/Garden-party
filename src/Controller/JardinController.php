<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FleurRepository;
use App\Repository\FruitRepository;
Use App\Repository\LegumeRepository;

class JardinController extends AbstractController
{
    /**
     * @Route("/jardin", name="jardin")
     */
    public function index(FleurRepository $fleurRepo, FruitRepository $fruitRepo, LegumeRepository $legumRepo)
    {
    	$fleurs = $fleurRepo->findAll();
    	$fruits = $fruitRepo->findAll();
    	$legumes = $legumRepo->findAll();

        return $this->render('jardin/index.html.twig', [
        	'fruits' => $fruits,
        	'fleurs' => $fleurs,
        	'legumes' => $legumes
        ]);
    }
}
