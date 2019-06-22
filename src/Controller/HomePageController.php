<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;

class HomePageController
{
    public function indexAction(TranslatorInterface $translator, Request $request)
    {
    	$translated = $translator->trans('Symfony c\'est super' );
    	$locale = $request->getLocale();
    	// dump($locale);
		return new Response(
            '<html><body><h1>'. $translated .'</h1></body></html>'
        );
    }
}