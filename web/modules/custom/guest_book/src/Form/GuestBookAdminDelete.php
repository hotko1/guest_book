<?php

namespace Drupal\guest_book\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Add class GuestBookAdminDelete.
 *
 * @package Drupal\gueat_book
 */
class GuestBookAdminDelete extends ConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public $id;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'delete_admin';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Delete data');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('guest_book.admin_panel');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('Do you want to delete data number %id ?', [
      '%id' => $this->id,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete it');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelText() {
    return $this->t('Cancel');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL) {
    $this->id = $id;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $query = \Drupal::database();
    $id = $this->id;
    $fid_avatar = $query
      ->select('guest_book', 'data')
      ->condition('id', $id)
      ->fields('data', ['fid_avatar', 'fid_image'])
      ->execute()->fetchAll();
    $fid_avatar = json_decode(json_encode($fid_avatar), TRUE);
    foreach ($fid_avatar as $key_avatar) {
      $key_avatar = $key_avatar['fid_avatar'];
      $query_ava = \Drupal::database();
      $query_ava->update('file_managed')
        ->condition('fid', $key_avatar)
        ->fields(['status' => '0'])
        ->execute();
    }
    foreach ($fid_avatar as $key_avatar) {
      $key_avatar = $key_avatar['fid_image'];
      $query_ava = \Drupal::database();
      $query_ava->update('file_managed')
        ->condition('fid', $key_avatar)
        ->fields(['status' => '0'])
        ->execute();
    }

    $query->delete('guest_book')
      ->condition('id', $this->id)
      ->execute();

    \Drupal::messenger()->addStatus('Successfully deleted.');
    $form_state->setRedirect('guest_book.admin_panel');
  }

}
