<?php

namespace Drupal\greet;

use Symfony\Component\EventDispatcher\Event;


class GreetEvent extends Event {


    const EVENT = 'greet.greet_event';

    protected $message;

    public function getValue() {
        return $this->message;
    }

    public function setValue($message) {
        $this->message = $message;
    }
}