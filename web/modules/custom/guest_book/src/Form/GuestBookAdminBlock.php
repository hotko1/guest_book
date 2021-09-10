<?php

namespace Drupal\guest_book\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\Component\Serialization\Json;

/**
 * Provides a block called "Example guest book block".
 */
class GuestBookAdminBlock extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return "guest_book-list";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $query = \Drupal::database()->select('guest_book', 'n');
    $query->fields('n', [
      'id',
      'name_user',
      'email_user',
      'phone_user',
      'message_user',
      'fid_avatar',
      'fid_image',
      'time_user',
    ]);
    $result = $query->execute()->fetchAll();
    $result = array_reverse($result);
    $options = [];

    $header = [
      'id' => 'Id',
      'name_user' => $this->t('Name'),
      'email_user' => $this->t('Email user'),
      'phone_user' => $this->t('Phone user'),
      'message_user' => $this->t('Message user'),
      'fid_avatar' => $this->t('Avatar'),
      'fid_image' => $this->t('Image'),
      'time_user' => $this->t('Time'),
      'delete' => $this->t('Delete'),
      'edit' => $this->t('Edit'),
    ];

    foreach ($result as $data) {
      $times = $data->time_user;
      $time_out = date("d/m/Y H:i:s", $times);

      $domen = $_SERVER['SERVER_NAME'];
      $file_ava = File::load($data->fid_avatar);
      if (is_null($file_ava)) {
        //        $data->fid_avatar = '';
        $image_ava = '/modules/custom/guest_book/files/default_ava.png';
      }
      else {
        $image_ava = $file_ava->createFileUrl();
      }
      //      $image_ava = $file_ava->createFileUrl();
      $url_ava = "//{$domen}{$image_ava}";
      $out_ava = '<img class="avatar-user" src="' . $url_ava . '" alt="User avatar">';
      //      $out_ava_link = '<a class="link-avatar" href="' . $url_ava . '" target="_blank">' . $out_ava . '</a>';
      $render_ava = render($out_ava);
      $ava_markup = Markup::create($render_ava);

      $file_img = File::load($data->fid_image);
      if (is_null($file_img)) {
        $img_markup = '';
      }
      else {
        $image_img = $file_img->createFileUrl();
        $url_img = "//{$domen}{$image_img}";
        $out_img = '<img class="image-user" src="' . $url_img . '" alt="User image">';
        $out_img_link = '<a class="link-image" href="' . $url_img . '" target="_blank">' . $out_img . '</a>';
        $render_img = render($out_img_link);
        $img_markup = Markup::create($render_img);
      }
      //      $image_img = $file_img->createFileUrl();
      //      $url_img = "//{$domen}{$image_img}";
      //      $out_img = '<img class="image-user" src="' . $url_img . '" alt="User image">';
      //      $out_img_link = '<a class="link-image" href="' . $url_img . '" target="_blank">' . $out_img . '</a>';
      //      $render_img = render($out_img_link);
      //      $img_markup = Markup::create($render_img);

      $text_delete = t('Delete');
      $url_delete = Url::fromRoute('guest_book.admin_delete', ['id' => $data->id], []);
      $url_delete->setOptions([
        'attributes' => [
          'class' => ['use-ajax', 'button', 'button-small'],
          'data-dialog-type' => 'modal',
          'data-dialog-options' => Json::encode(['width' => 400]),
        ],
      ]);
      $link_delete = Link::fromTextAndUrl($text_delete, $url_delete);

      $text_edit = t('Edit');
      $url_edit = Url::fromRoute('guest_book.admin_edit', ['id' => $data->id], []);
      $url_edit->setOptions([
        'attributes' => [
          'class' => ['use-ajax', 'button', 'button-small'],
          'data-dialog-type' => 'modal',
          'data-dialog-options' => Json::encode(['width' => 400]),
        ],
      ]);
      $link_edit = Link::fromTextAndUrl($text_edit, $url_edit);

      $_id = $data->id;
      $options[] = [
        'id' => $_id,
        'fid_avatar' => $ava_markup,
        'name_user' => $data->name_user,
        'time_user' => $time_out,
        'fid_image' => $img_markup,
        'message_user' => $data->message_user,
        'email_user' => $data->email_user,
        'phone_user' => $data->phone_user,
        'delete' => $link_delete,
        'edit' => $link_edit,
      ];

      global $_id;
    }

    $form['table'] = [
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => $this->t('No response found.'),
    ];

    $form['delete select'] = [
      '#type' => 'submit',
      '#value' => $this->t('Delete selected'),
      '#attributes' => ['onclick' => 'if(!confirm("Do you want to delete data?")){return false;}'],
    ];

//    $revers = array_reverse($rows);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues()['table'];
    $deletes = array_filter($values);

    if ($deletes == NULL) {
      $form_state->setRedirect('guest_book.admin_panel');
    }
    else {
      $fid_ava = \Drupal::database()->select('guest_book', 'm')
        ->condition('id', $deletes, 'IN')
        ->fields('m', ['fid_avatar'])
        ->execute()->fetchAll();
      $fid_ava = json_decode(json_encode($fid_ava), TRUE);
      foreach ($fid_ava as $key_ava) {
        $key_ava = $key_ava['fid_avatar'];
        $query_ava = \Drupal::database();
        $query_ava->update('file_managed')
          ->condition('fid_avatar', $key_ava, 'IN')
          ->fields(['status' => '0'])
          ->execute();
      }

      $fid_img = \Drupal::database()->select('guest_book', 'k')
        ->condition('id', $deletes, 'IN')
        ->fields('k', ['fid_image'])
        ->execute()->fetchAll();
      $fid_img = json_decode(json_encode($fid_img), TRUE);
      foreach ($fid_img as $key_img) {
        $key_img = $key_img['fid_image'];
        $query_img = \Drupal::database();
        $query_img->update('file_managed')
          ->condition('fid_image', $key_img, 'IN')
          ->fields(['status' => '0'])
          ->execute();
      }

      $query = \Drupal::database();
      $query->delete('guest_book')
        ->condition('id', $deletes, 'IN')
        ->execute();
      $this->messenger()->addStatus($this->t('Successfully deleted'));
    }
  }

}
