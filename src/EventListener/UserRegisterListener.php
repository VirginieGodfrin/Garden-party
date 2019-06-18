<?php

namespace App\EventListener;

use App\Event\UserRegisterEvent;
use Symfony\Component\EventDispatcher\Event;

class UserRegisterListener 
{

    public function onUserRegister(Event $event): void
    {
        $userFullName = $event->getUser()->getFullName();
        if ($userFullName) {
        	dump($userFullName); die;
            $event->getUser()->setDescription( $userFullName . ' fait de jolies choses');
        }
    }
}