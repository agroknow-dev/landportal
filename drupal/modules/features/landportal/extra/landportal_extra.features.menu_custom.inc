<?php
/**
 * @file
 * landportal_extra.features.menu_custom.inc
 */

/**
 * Implements hook_menu_default_menu_custom().
 */
function landportal_extra_menu_default_menu_custom() {
  $menus = array();

  // Exported menu: user-menu.
  $menus['user-menu'] = array(
    'menu_name' => 'user-menu',
    'title' => 'Join us',
    'description' => 'Welcome to the Land Portal! Fill out this form to create an account. Once you submit, we will receive a notification to approve your account.',
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Join us');
  t('Welcome to the Land Portal! Fill out this form to create an account. Once you submit, we will receive a notification to approve your account.');


  return $menus;
}
