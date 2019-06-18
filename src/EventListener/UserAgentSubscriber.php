<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Psr\Log\LoggerInterface;

class UserAgentSubscriber implements EventSubscriberInterface
{
	private $logger;

	public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

	public function onKernelRequest(GetResponseEvent $event)
    {
    	
    	$request = $event->getRequest();
    	$userAgent = $request->headers->get('user-agent');
    	$this->logger->info('Hello' . $userAgent .'!');
        
    }
    public static function getSubscribedEvents()
    {
        return array(
            'kernel.request' => 'onKernelRequest'
        );
    }

}