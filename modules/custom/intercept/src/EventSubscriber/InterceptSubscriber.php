<?php

namespace Drupal\intercept\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\greet\GreetEvent;
use Drupal\Core\Session\AccountProxyInterface;

class InterceptSubscriber implements EventSubscriberInterface {
    protected $currentUser;

    public function __construct(AccountProxyInterface $currentUser) {
        $this->currentUser = $currentUser;
    }

    public static function getSubscribedEvents() {
        $events['greet.greet_event'][] = array('setNewMessage', 0);
        return $events;
    }

    public function setNewMessage(GreetEvent $event) {

        // kint($event);

        $original_message = $event->getValue();

        $role = $this->currentUser->getRoles();        
        $event->setValue($original_message . ' --- ' . count($role));
    }
}