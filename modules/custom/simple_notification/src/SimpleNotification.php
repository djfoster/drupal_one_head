<?php

namespace Drupal\simple_notification;

use Drupal\node\Entity\NodeType;
use Drupal\simple_notification\SimpleNotification;

/**
 * Provides a simple notification object.
 */
class SimpleNotification {
  
  /**
   * {@inheritdoc}
   */
  public static function saveSettings($values) { 
    $content_types = SimpleNotification::getContentTypes();
    // Retrieve the configuration
    $config = \Drupal::configFactory()->getEditable('simple_notification.settings');  
    foreach ($content_types as $bundle => $label) {
      //Set the submitted configuration setting
      $config->set('activate_' . $bundle, $values['activate_' . $bundle]);
      $config->set('roles_' . $bundle, $values['roles_' . $bundle]);
    }
    $config->save();
  }
  
  /**
   * {@inheritdoc}
   */
  public static function getSettings($bundle) { 
    $settings_notification = [];
    $activate = \Drupal::config('simple_notification.settings')->get('activate_' . $bundle);
    $settings_notification['activate'] = $activate;
    $roles = \Drupal::config('simple_notification.settings')->get('roles_' . $bundle);
    
    if (empty($roles)) return $settings_notification;
    
    foreach ($roles as $key => $value) {
      if ($value === 0) unset($roles[$key]);
    }
    $settings_notification['roles'] = $roles;
    
    return $settings_notification;
  }
  
  /**
   * {@inheritdoc}
   */
  public static function getContentTypes() {
    $content_types = NodeType::loadMultiple();
    foreach ($content_types as $key => $content_type) {
      $content_types[$key] = $content_type->label();
    }
    
    return $content_types;
  }
}

