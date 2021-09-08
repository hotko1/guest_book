<?php

namespace Drupal\guest_book\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\Component\Serialization\Json;

/**
 * Provides a block called "Example guest book block".
 */
class GuestBookBlock extends Database {

  /**
   * {@inheritdoc}
   */
  public function build() {
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
    $rows = [];

    foreach ($result as $data) {
      $times = $data->time_user;
      $time_out = date("d/m/Y H:i:s", $times);

      $domen = $_SERVER['SERVER_NAME'];
      $file_ava = File::load($data->fid_avatar);
      $image_ava = $file_ava->createFileUrl();
      $url_ava = "//{$domen}{$image_ava}";
      $out_ava = '<img class="avatar-user" src="' . $url_ava . '" alt="User avatar">';
      $out_ava_link = '<a class="link-avatar" href="' . $url_ava . '" target="_blank">' . $out_ava . '</a>';
      $render_ava = render($out_ava_link);
      $ava_markup = Markup::create($render_ava);

      $file_img = File::load($data->fid_image);
      $image_img = $file_img->createFileUrl();
      $url_img = "//{$domen}{$image_img}";
      $out_img = '<img class="avatar-user" src="' . $url_img . '" alt="User avatar">';
      $out_img_link = '<a class="link-avatar" href="' . $url_img . '" target="_blank">' . $out_img . '</a>';
      $render_img = render($out_img_link);
      $img_markup = Markup::create($render_img);

      $text_delete = t('Delete');
      $url_delete = Url::fromRoute('guest_book.delete_form', ['id' => $data->id], []);
      $url_delete->setOptions([
        'attributes' => [
          'class' => ['use-ajax', 'button', 'button-small'],
          'data-dialog-type' => 'modal',
          'data-dialog-options' => Json::encode(['width' => 400]),
        ],
      ]);
      $link_delete = Link::fromTextAndUrl($text_delete, $url_delete);

      $text_edit = t('Edit');
      $url_edit = Url::fromRoute('guest_book.edit_form', ['id' => $data->id], []);
      $url_edit->setOptions([
        'attributes' => [
          'class' => ['use-ajax', 'button', 'button-small'],
          'data-dialog-type' => 'modal',
          'data-dialog-options' => Json::encode(['width' => 400]),
        ],
      ]);
      $link_edit = Link::fromTextAndUrl($text_edit, $url_edit);

      $rows[] = [
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
    }

    $revers = array_reverse($rows);

    return $revers;
  }

}
