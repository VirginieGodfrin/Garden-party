<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
Use App\Entity\Mangeur;
use App\Repository\MangeurRepository;

/**
 * @Route("/mangeur", name="mangeur_")
 */
class MangeurController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(MangeurRepository $mangeurRepo, EntityManagerInterface $em, $isMac) 
    {
    	$mangeurs = $mangeurRepo->giveMeAllMangeurs();
        $mangeursLegumes = $mangeurRepo->giveMeAllMangeursLegumes('legume');
        // dump($post);
        return $this->render('mangeur/index.html.twig', [
            'mangeurs' => $mangeurs,
            'mangeursLegumes' => $mangeursLegumes,
            'isMac' => $isMac
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @ParamConverter("mangeur", class="App:Mangeur")
     */
    public function showAction(Mangeur $mangeur)
    {
        dump($mangeur);
        return $this->render('mangeur/show.html.twig');
    }
}
