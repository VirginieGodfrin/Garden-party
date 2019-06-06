<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MangeurRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/mangeur", name="mangeur_")
 */
class MangeurController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(MangeurRepository $mangeurRepo, EntityManagerInterface $em)
    {
    	$mangeurs = $mangeurRepo->giveMeAllMangeurs();
        $mangeursLegumes = $mangeurRepo->giveMeAllMangeursLegumes('legume');
        dump($mangeursLegumes);
        return $this->render('mangeur/index.html.twig', [
            'mangeurs' => $mangeurs,
            'mangeursLegumes' => $mangeursLegumes
        ]);
    }
}
