<?php

namespace Drupal\guest_book\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\guest_book\Form\GuestBookBlock;

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

    $table_out = new GuestBookBlock();
    $table_output = $table_out->build();

    return [
      '#theme' => 'guest_book',
      '#forms' => $simple_form,
      '#tables' => $table_output,
      '#title' => $this->t('Hello! You can add here a response.'),
    ];
  }

}
