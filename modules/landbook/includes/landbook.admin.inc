<?php
/**
 * @file
 * Administration page callbacks for Landbook module
 *
 * The Landportal landbook
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

/**
 * From builder.
 */

function landbook_admin_settings() {
  $form['landbook_api'] = array(
    '#type'             => 'textfield',
    '#title'            => 'API URL',
    '#description'      => t('Give the URL to a Landbook API'),
    '#default_value'    => variable_get('landbook_api', 'http://localhost/api'),
  );
  $form['landbook_receiver'] = array(
    '#type'             => 'textfield',
    '#title'            => 'Receiver URL',
    '#description'      => t('Give the URL to a Landbook Receiver'),
    '#default_value'    => variable_get('landbook_api', 'http://localhost/receiver'),
  );
  $form['landbook_ckan'] = array(
    '#type'             => 'textfield',
    '#title'            => 'CKAN URL',
    '#description'      => t('Give the URL to the Landportal CKAN portal'),
    '#default_value'    => variable_get('landbook_api', 'http://localhost/data'),
  );
  $form['landbook_sparql'] = array(
    '#type'             => 'textfield',
    '#title'            => 'Sparql URL',
    '#description'      => t('URL to the Landportal SPARQL endpoint'),
    '#default_value'    => variable_get('landbook_api', 'http://localhost/sparql'),
  );

  $form['#submit'][] = 'landbook_admin_settings_submit';
  return system_settings_form($form);
}


/**
 * Dummy check (see @TODO) to see if sumbited values are URL
 */
function landbook_admin_settings_validate($form, &$form_state) {
  $t = array('landbook_api', 'landbook_receiver', 'landbook_ckan', 'landbook_sparql');
  foreach ($t as $v) {
    if (!startswith($form_state['values'][$v], 'http')) {
      form_set_error($v, t($v.' must be a valid URL'));
    }
    // @TODO ping URL to check if it responds or print warning (not a fatal error)
  }
}


/**
 * Store new values in variables
 */
function landbook_admin_settings_submit($form, $form_state) {
  $t = array('landbook_api', 'landbook_receiver', 'landbook_ckan', 'landbook_sparql');
  foreach ($t as $v) {
    variable_set($v, $form_state['values'][$v]);
    watchdog('Landbook', 'Updated ' . $v . ' value to ' . $form_state['values'][$v]);
  }
}
