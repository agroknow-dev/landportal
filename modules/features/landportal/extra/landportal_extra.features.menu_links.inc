<?php
/**
 * @file
 * landportal_extra.features.menu_links.inc
 */

/**
 * Implements hook_menu_default_menu_links().
 */
function landportal_extra_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: user-menu_sign-in:user/login
  $menu_links['user-menu_sign-in:user/login'] = array(
    'menu_name' => 'user-menu',
    'link_path' => 'user/login',
    'router_path' => 'user/login',
    'link_title' => 'Sign in',
    'options' => array(
      'attributes' => array(
        'title' => '',
      ),
      'identifier' => 'user-menu_sign-in:user/login',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Sign in');


  return $menu_links;
}
