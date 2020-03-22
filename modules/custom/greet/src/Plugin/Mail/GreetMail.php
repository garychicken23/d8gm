<?php

namespace Drupal\greet\Plugin\Mail;

use Drupal\Core\Mail\MailFormatHelper;
use Drupal\Core\Mail\MailInterface;
use Drupal\core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the greet mail backend.
 * 
 * @Mail(
 *   id = "greet_mail_id",
 *   lable = @Translation("Greet mailer label"),
 *   description = @Translation("sends out emails using moudude specific APIs)
 * )
 */
class GreetMail implements MailInterface, ContainerFactoryPluginInterface {
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static();
    }

    public function format(array $message) {
        $message['body'] = implode("\n\n", $message['body']);

        $message['body'] = MailFormatHelper::htmlToText($message['body']);

        $message['body'] = MailFormatHelper::wrapMail($message['body']);

        return $message;
    }

    public function mail(array $message) {
        // kint($message);exit();
    }
}