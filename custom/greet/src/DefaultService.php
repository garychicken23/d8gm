<?php

namespace Drupal\greet;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class DefaultService.
 */
class DefaultService {

  /**
   * Drupal\Core\Session\AccountProxyInterface definition.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;
  protected $configFactory;
  protected $eventDispatcher;

  /**
   * Constructs a new DefaultService object.
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
   */
  public function __construct(AccountProxyInterface $current_user, ConfigFactoryInterface $config_factory, EventDispatcherInterface $eventDispatcher) {
    $this->currentUser = $current_user;
    $this->configFactory = $config_factory;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * get username of the current user.
   */
  public function getUsername(){
    return $this->currentUser->getEmail();
  }

  public function getMessage() {
    $config = $this->configFactory->get('greeting.custom_greeting');
    $message = $config->get('greet');
    // if (!empty($message)) {
    //   return $message;
    // }

    if(!empty($message)) {
      $event = new GreetEvent();
      $event->setValue($message);
      $event = $this->eventDispatcher->dispatch(GreetEvent::EVENT, $event);

      return $event->getValue();
    }

  }
}
