<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegisterType;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventDispatcher;
use App\Event\UserRegisterEvent;

/**
 * @Route("/{_locale}/user", name="user_", 
 *     requirements={
 *         "_locale"="%app.locales%"
 *     })
 */
class UserController extends Controller
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
