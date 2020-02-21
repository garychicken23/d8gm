<?php

namespace Drupal\greet\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\greet\DefaultService;
/**
 * Class DefaultController.
 */
class DefaultController extends ControllerBase {
  protected $greet;

  public static function create(ContainerInterface $container){
    return new static(
      $container->get('greet.from_current_user')
    );
  }

  public function __construct(DefaultService $greet) {
    $this->greet = $greet;
  }

  /**
   * Sayhi.
   *
   * @return string
   *   Return Hello string.
   */
  public function sayhi() {

    // kint($this);    exit();
    // return new \Symfony\Component\HttpFoundation\RedirectResponse("/node/1");

    return [
      '#type' => 'markup',
      '#markup' => $this->t("@user said @message!", [
        "@user" => $this->greet->getUsername(),
        "@message" => $this->greet->getMessage(),
      ])
    ];
  }

}
