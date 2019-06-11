<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegisterType;
use App\Entity\User;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, EntityManagerInterface $em)
    {
        $user = new User;
    	$form = $this->createForm(RegisterType::class, $user);
    	$form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $type = $form['type']->getData();
            $type->setNom($user->getNom());
            $type->setPrenom($user->getPrenom());

            $em->persist($type); 
            $em->flush();

            if($type->getClassName() === "Mangeur"){
                return $this->redirectToRoute('mangeur_index');
            }

            if($type->getClassName() === "Jardinier") {
                 return $this->redirectToRoute('jardinier_index');
            }
        }

        return $this->render('user/register.html.twig', [
        	'form' => $form->createView(),
        ]);
    }
}
