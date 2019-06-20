<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class UserAgentSubscriber implements EventSubscriberInterface
{
	private $logger;

	public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    // A chaque fois q'un utilise GetResponseEvent on fait appel à l'objet GetResponseEvent créer dans le HTTPKERNEL
	public function onKernelRequest(GetResponseEvent $event)
    {
    	
    	$request = $event->getRequest();
    	$userAgent = $request->headers->get('user-agent');
    	$this->logger->info('Hello' . $userAgent .'!');
        // $response = new Response('Come back later');
        // $event->setResponse($response);
        $isMac = stripos($userAgent, 'Mac') !== false;
        $request->attributes->set('isMac', $isMac);
        
    }
    public static function getSubscribedEvents()
    {
        return array(
            // constant that means kernel.request
            // KernelEvents::REQUEST => 'onKernelRequest'
            'kernel.request' => 'onKernelRequest'
        );
    }

}