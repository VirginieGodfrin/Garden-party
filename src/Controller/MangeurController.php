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
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * @Route("/{_locale}/mangeur", name="mangeur_", 
 *     requirements={
 *         "_locale"="%app.locales%"
 *     })
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
        
        // this request is an other one !
        // This is an request Objet and it doesn't fave the same query parameter 
        // than the subrequest render in the template
        // $request = new Request();
        // $request->attributes->set(
        //     '_controller',
        //     'App\Controller\MangeurController::_latestTweetsAction'
        // );
        // $httpKernel = $this->container->get('http_kernel');
        // $response = $httpKernel->handle(
        //     $request,
        //     HttpKernelInterface::SUB_REQUEST
        // );
        

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

    public function _latestTweetsAction($userOnMac)
    {
        $tweets = [
            'Aujourd\'hui on mange des pâtes',
            'Bonjour tout le monde... ',
            'Concert à la plage...'
        ];

        return $this->render('mangeur/_latestTweets.html.twig', [
            'tweets' => $tweets,
            'isMac' => $userOnMac
        ]);


    }
}
