<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JardinController extends AbstractController
{
    /**
     * @Route("/jardin", name="jardin")
     */
    public function index()
    {
        return $this->render('jardin/index.html.twig', [
            'controller_name' => 'JardinController',
        ]);
    }
}
