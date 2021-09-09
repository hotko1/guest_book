<?php

namespace Drupal\guest_book\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * This is our guest book controller.
 */
class GuestBookAdminController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function content() {
    $simple_form = \Drupal::formBuilder()
      ->getForm('\Drupal\guest_book\Form\GuestBookAdminBlock');

    return [
      '#theme' => 'guest-book-admin',
      '#forms' => $simple_form,
    ];
  }

}
