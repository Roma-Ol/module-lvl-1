<?php

namespace Drupal\guestbook\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Datetime\DrupalDateTime;


/**
 * @ContentEntityType(
 *   id = "Guestbook",
 *   label = @Translation("Guestbook"),
 *   base_table = "guestbookdatabase",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 * )
 */
class Guestbook extends ContentEntityBase {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    // Get the field definitions for 'id' and 'uuid' from the parent.
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE);

    $fields['date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date'))
      ->setRequired(TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'));

    return $fields;
  }

  /**
   * @return string
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * @param string  $title
   *
   * @return $this
   */
  public function setTitle($title) {
    return $this->set('title', $title);
  }

  /**
   * @return \Drupal\Core\Datetime\DrupalDateTime
   */
  public function getDate() {
    return $this->get('date')->date;
  }

  /**
   * @param   \Drupal\Core\Datetime\DrupalDateTime  $date
   *
   * @return $this
   */
  public function setDate(DrupalDateTime $date) {
    return $this->set('date', $date->format(DATETIME_DATETIME_STORAGE_FORMAT));
  }

  /**
   * @return \Drupal\filter\Render\FilteredMarkup
   */
  public function getDescription() {
    return $this->get('description')->processed;
  }

  /**
   * @param   string  $description
   * @param   string  $format
   *
   * @return $this
   */
  public function setDescription($description, $format) {
    return $this->set('description', [
      'value'  => $description,
      'format' => $format,
    ]);
  }


}
