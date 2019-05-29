<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomePageController
{
    public function indexAction()
    {
		return new Response(
            '<html><body><h1> Welkome to garden party !</h1></body></html>'
        );
    }
}