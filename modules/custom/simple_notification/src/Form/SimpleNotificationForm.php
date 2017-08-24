<?php

namespace Drupal\simple_notification\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\Role;
use Drupal\simple_notification\SimpleNotification;

/**
 * Provides a simple notification form.
 */
class SimpleNotificationForm extends ConfigFormBase {
  
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'simple_notification_settings';
  }
  
  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'simple_notification.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $roles = $this->optionsRoles();
    $content_types = SimpleNotification::getContentTypes();
    foreach ($content_types as $bundle => $label) {
      $form['content_types'][$bundle] = [
        '#title' => $this->t($label),
        '#type' => 'details',
      ];
      
      $settings_notification = SimpleNotification::getSettings($bundle);
      $form['content_types'][$bundle]['activate_' . $bundle] = [
        '#title' => $this->t('To enable notification when creating node of type @type', ['@type' => $label]),
        '#type' => 'checkbox',
        '#default_value' => $settings_notification['activate'],
      ];
      
      $form['content_types'][$bundle]['roles_' . $bundle] = [
        '#title' => $this->t('Roles'),
        '#type' => 'checkboxes',
        '#options' => $roles,
        '#default_value' => isset($settings_notification['roles']) ? $settings_notification['roles'] : [],
      ];
    }
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    SimpleNotification::saveSettings($form_state->getValues());
    parent::submitForm($form, $form_state);
  }
  
  /**
   * {@inheritdoc}
   */
  private function optionsRoles() {
    $roles = Role::loadMultiple();
    unset($roles['anonymous']);
    unset($roles['authenticated']);
    foreach ($roles as $key => $role) {
      $roles[$key] = $role->label();
    }
    
    return $roles;
  }
}