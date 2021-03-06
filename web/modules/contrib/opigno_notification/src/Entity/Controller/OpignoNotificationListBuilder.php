<?php

namespace Drupal\opigno_notification\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\user\Entity\User;

/**
 * Provides a list controller for opigno_notification entity.
 *
 * @ingroup opigno_notification
 */
class OpignoNotificationListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['uid'] = $this->t('User');
    $header['message'] = $this->t('Message');
    $header['has_read'] = $this->t('Has Read');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\opigno_notification\OpignoNotificationInterface $entity */
    $row['id'] = $entity->id();

    $user_id = $entity->getUser();
    if ($user_id && $user = User::load($user_id)) {
      $row['uid'] = $user->toLink()->toString();
    }
    else {
      $user_id = $user_id ? ' (id: ' . $user_id . ')' : '';
      $row['uid'] = t('User not exists') . $user_id;
    }

    $row['message'] = $entity->getMessage();
    $row['has_read'] = $entity->getHasRead() ? 'Yes' : 'No';
    return $row + parent::buildRow($entity);
  }

}
