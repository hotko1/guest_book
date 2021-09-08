<?php

namespace Drupal\guest_book\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * This is our guest book controller.
 */
class GuestBookController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function content() {
    $simple_form = \Drupal::formBuilder()
      ->getForm('\Drupal\guest_book\Form\GuestBookForm');

    return $simple_form;
  }

}
