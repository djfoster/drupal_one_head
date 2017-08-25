<?php

namespace Drupal\mac_examples\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a mac examples form.
 */
class MacExamplesForm extends FormBase {
  
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mac_examples_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['caja_de_texto_1'] = array(
      '#type' => 'textfield',
      '#title' => 'Caja de texto 1',
    );
    
    $form['area_de_texto_1'] = array(
      '#type' => 'textarea',
      '#title' => 'Area de texto 1',
    );
    
    $form['checkbox_1'] = array(
      '#type' => 'checkbox',
      '#title' => 'Marca esta opción',
    );
    
    $form['color_1'] = array(
      '#type' => 'color',
      '#title' => 'Elije un color',
    );
    
    $form['fecha_1'] = array(
      '#type' => 'date',
      '#title' => 'Fecha 1',
    );
    
    $form['email_1'] = array(
      '#type' => 'email',
      '#title' => 'Ingresa correo electrónico',
    );
    
    $form['numero_1'] = array(
      '#type' => 'number',
      '#title' => 'Ingresa un número',
    );
    
    $form['actions']['#type'] = 'actions';
    
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Enviar',
    );
    
    return $form;
  }
  
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message('Caja de texto 1: ' . $form_state->getValue('caja_de_texto_1'), 'status');
    
    drupal_set_message('Area de texto 1: ' . $form_state->getValue('area_de_texto_1'), 'status');
    
    drupal_set_message('Marca esta opción: ' . $form_state->getValue('checkbox_1'), 'status');
    
    drupal_set_message('Elije un color: ' . $form_state->getValue('color_1'), 'status');
    
    drupal_set_message('Fecha 1: ' . $form_state->getValue('fecha_1'), 'status');
    
    drupal_set_message('Ingresa correo electrónico: ' . $form_state->getValue('email_1'), 'status');
    
    drupal_set_message('Ingresa un número: ' . $form_state->getValue('numero_1'), 'status');
  }
  
}