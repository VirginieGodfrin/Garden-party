<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FruitRepository;
use App\Repository\ArbreRepository;

/**
 * @Route("/fruit", name="fruit_")
 */
class FruitController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(FruitRepository $fruitrepo)
    {
    	// $fruits = $fruitrepo->findAll();
        $fruits = $fruitrepo->giveMeAllFruit();

        $arbres = $fruitrepo->giveMeAllArbresDQL();

        $arbresAfruits = $fruitrepo->giveMeAllArbresWithFruitsDQL();

        return $this->render('fruit/index.html.twig', [
        	'fruits' => $fruits,
            'arbres' => $arbres,
            'arbresAfruits' => $arbresAfruits
        ]);
    }
}
