<?php
/**
 * @file
 * Administration page callbacks for Landdebate module
 *
 * The Landportal landdebate
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

/**
 * From builder.
 */

function landdebate_admin_settings() {
  $form['landdebate_content_types'] = array(
    '#type'             => 'textfield',
    '#title'            => 'Content types entries',
    '#description'      => t('Comma separated list of content types to be included in the landdebate'),
    '#default_value'    => variable_get('landdebate_content_types', 'news, blog_post, event, debate, organization'),
  );
  $form['landdebate_display_entries'] = array(
    '#type'             => 'textfield',
    '#title'            => 'Number of entries',
    '#description'      => t('Number of entries (including sticky) to display in each Debate sections'),
    '#default_value'    => variable_get('landdebate_display_entries', 5),
  );

  $form['#submit'][] = 'landdebate_admin_settings_submit';
  return system_settings_form($form);
}

function landdebate_admin_social() {
  $form['landdebate_twitter'] = array(
    '#type'             => 'textfield',
    '#title'            => 'Twitter',
    '#description'      => t('Twitter account'),
    '#default_value'    => variable_get('landdebate_twitter', ''),
  );
  $form['landdebate_facebook'] = array(
    '#type'             => 'textfield',
    '#title'            => 'Facebook',
    '#description'      => t('Facebook pageID'),
    '#default_value'    => variable_get('landdebate_facebook', ''),
  );

  $form['#submit'][] = 'landdebate_admin_settings_submit';
  return system_settings_form($form);
}

/**
 * Store new values in variables
 */
function landdebate_admin_settings_submit($form, $form_state) {
  // @TODO
  // do sumething

}
