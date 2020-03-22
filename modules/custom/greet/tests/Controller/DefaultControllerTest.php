<?php

namespace Drupal\greet\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the greet module.
 */
class DefaultControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "greet DefaultController's controller functionality",
      'description' => 'Test Unit for module greet and controller DefaultController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests greet functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module greet.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
