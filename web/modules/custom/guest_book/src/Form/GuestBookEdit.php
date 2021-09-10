<?php

namespace Drupal\guest_book\Form;

use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Use Class GuestBookEdit.
 *
 * @package Drupal\guest_book\Form
 */
class GuestBookEdit extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'guest_book_form-edit';
  }

  /**
   * {@inheritdoc}
   */
  public $id;

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL) {
    $this->id = $id;
    $conn = Database::getConnection();
    $query = $conn->select('guest_book', 'n')
      ->condition('id', $id)
      ->fields('n');
    $data = $query->execute()->fetchAssoc();

    $form['result_message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>',
    ];
    $form['name_message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="name-result_message"></div>',
    ];
    $form['name_user'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name:'),
      '#required' => TRUE,
      '#default_value' => (isset($data['name_user'])) ? $data['name_user'] : '',
      '#attributes' => [
        'placeholder' => $this->t('The length of name is 2-100 letters.'),
      ],
    ];
    $form['email_message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="email-result_message"></div>',
    ];
    $form['email_user'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your email:'),
      '#required' => TRUE,
      '#default_value' => (isset($data['email_user'])) ? $data['email_user'] : '',
      '#attributes' => [
        'placeholder' => 'example@email.com',
      ],
      '#ajax' => [
        'callback' => '::mailValidateCallback',
        'event' => 'change',
      ],
    ];
    $form['phone_message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="phone-result_message"></div>',
    ];
    $form['phone_user'] = [
      '#type' => 'tel',
      '#title' => $this->t('Your phone:'),
      '#required' => TRUE,
      '#default_value' => (isset($data['phone_user'])) ? $data['phone_user'] : '',
      '#attributes' => [
        'placeholder' => '99 999 999 9999',
      ],
    ];
    $form['message_message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="message-result_message"></div>',
    ];
    $form['message_user'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Your message:'),
      '#required' => TRUE,
      '#default_value' => (isset($data['message_user'])) ? $data['message_user'] : '',
    ];
    $form['avatar_message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="avatar-result_message"></div>',
    ];
    $form['fid_avatar'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Download avatar'),
      '#default_value' => [$data['fid_avatar']],
      '#description' => $this->t('Avatar should be less than 2 MB and in JPEG, JPG or PNG format.'),
      '#upload_validation' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_size' => [2097152],
      ],
      '#upload_location' => 'public://images/avatar/',
    ];
    $form['image_message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="image-result_message"></div>',
    ];
    $form['fid_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Download image'),
      '#default_value' => [$data['fid_image']],
      '#description' => $this->t('Image should be less than 5 MB and in JPEG, JPG or PNG format.'),
      '#upload_validation' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_size' => [5242880],
      ],
      '#upload_location' => 'public://images/image/',
    ];
    $form['submit'] = [
      '#type' => 'button',
      '#value' => $this->t('Edit response'),
      '#ajax' => [
        'callback' => '::setMessage',
        'event' => 'click',
      ],
    ];

    global $_global_fid_ava;
    $_global_fid_ava = $data['fid_avatar'];
    global $_global_fid_img;
    $_global_fid_img = $data['fid_image'];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function mailValidateCallback(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    if (!preg_match('/^[a-z._@-]{0,100}$/', $form_state->getValue('email_user'))) {
      $response->addCommand(
        new HtmlCommand(
          '.email-result_message',
          '<div class="novalid">' . $this->t('Invalid mail.')
        )
      );
    }
    else {
      $response->addCommand(
        new HtmlCommand(
          '.email-result_message',
          NULL
        )
      );
    }

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function setMessage(array &$form, FormStateInterface $form_state, $id = NULL) {
//    \Drupal::messenger()->deleteAll();
    $response = new AjaxResponse();
    $user_name = strlen($form_state->getValue('name_user'));
    $user_avatar = ($form_state->getValue('fid_avatar'));
    $user_image = ($form_state->getValue('fid_image'));

    $fid_ava = json_decode(json_encode($user_avatar), TRUE);
    foreach ($fid_ava as $key_ava) {
      $key_ava = $key_ava['fid_avatar'];
    }
    $key_ava['0'] = $fid_ava;

    $fid_img = json_decode(json_encode($user_image), TRUE);
    foreach ($fid_img as $key_img) {
      $key_img = $key_img['fid_image'];
    }
    $key_img['0'] = $fid_img;

    if ($user_name < 2) {
      $response->addCommand(
        new HtmlCommand(
          '.name-result_message',
          '<div class="novalid">' . $this->t('Your name is too short. Please enter a full name.')
        )
      );
    }
    elseif (100 < $user_name) {
      $response->addCommand(
        new HtmlCommand(
          '.name-result_message',
          '<div class="novalid">' . $this->t('Your name is too long. Please enter a really name.')
        )
      );
    }
    elseif (!filter_var($form_state->getValue('email_user'), FILTER_VALIDATE_EMAIL)) {
      $response->addCommand(
        new HtmlCommand(
          '.email-result_message',
          '<div class="novalid">' . $this->t('Invalid mail.')
        )
      );
    }
    elseif (!preg_match('/^[0-9]{12}$/', $form_state->getValue('phone_user'))) {
      $response->addCommand(
        new HtmlCommand(
          '.phone-result_message',
          '<div class="novalid">' . $this->t('Your phone is incorrect.')
        )
      );
    }
    else {
      $response->addCommand(
        new HtmlCommand(
          '.result_message',
          '<div class="valid">' . $form_state->getValue('name_user') . $this->t('your message has been saved.')
        )
      );

      $file_fid_ava = $form_state->getValue('fid_avatar');
      $file_fid_img = $form_state->getValue('fid_image');
      $data = [
        'name_user' => $form_state->getValue('name_user'),
        'email_user' => $form_state->getValue('email_user'),
        'phone_user' => $form_state->getValue('phone_user'),
        'message_user' => $form_state->getValue('message_user'),
        'fid_avatar' => $file_fid_ava[0],
        'fid_image' => $file_fid_img[0],
      ];

      global $_global_fid_ava;
      $ava_fid = $_global_fid_ava;
      if ($file_fid_ava[0] != $ava_fid) {
        $query_ava = \Drupal::database();
        $query_ava->update('file_managed')
          ->condition('fid', $ava_fid)
          ->fields(['status' => '0'])
          ->execute();
      }

      global $_global_fid_img;
      $img_fid = $_global_fid_img;
      if ($file_fid_img[0] != $img_fid) {
        $query_img = \Drupal::database();
        $query_img->update('file_managed')
          ->condition('fid', $img_fid)
          ->fields(['status' => '0'])
          ->execute();
      }

      if (is_null($file_fid_ava[0])) {
        $data['fid_avatar'] = 0;
      }
      else {
        $file_ava = File::load($file_fid_ava[0]);
        $file_ava->setPermanent();
        $file_ava->save();
      }

      if (is_null($file_fid_img[0])) {
        $data['fid_image'] = 0;
      }
      else {
        $file_img = File::load($file_fid_img[0]);
        $file_img->setPermanent();
        $file_img->save();
      }

//      $file_ava = File::load($file_fid_ava[0]);
//      $file_ava->setPermanent();
//      $file_ava->save();
//
//      $file_img = File::load($file_fid_img[0]);
//      $file_img->setPermanent();
//      $file_img->save();

      if (isset($this->id)) {
        \Drupal::database()->update('guest_book')->fields($data)->condition('id', $this->id)->execute();
      }
      else {
        \Drupal::database()->insert('guest_book')->fields($data)->execute();
      }
      \Drupal::messenger()->addStatus('Successfully update');

      $response->addCommand(new RedirectCommand('/guest_book'));
    }

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {}

}
