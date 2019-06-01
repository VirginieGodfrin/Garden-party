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
    public function index()
    {
        return $this->render('jardin/index.html.twig');
    }
}
