<?php
/**
 * @file
 * Base Drupal7 settings for Landportal theme
 *
 * The Landportal theme
 *
 * Original work by: WESO (http://weso.es/)
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landportal_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date_default_timezone';
  $strongarm->value = 'Europe/Rome';
  $export['date_default_timezone'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date_first_day';
  $strongarm->value = '1';
  $export['date_first_day'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'site_default_country';
  $strongarm->value = 'IT';
  $export['site_default_country'] = $strongarm;

  return $export;
}


function landportal_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: main-menu_home:<front>
  $menu_links['main-menu_home:<front>'] = array(
                                                'menu_name' => 'main-menu',
                                                'link_path' => '<front>',
                                                'router_path' => '',
                                                'link_title' => 'home',
                                                'options' => array(
                                                                   'attributes' => array(
                                                                                         'title' => '',
                                                                                         ),
                                                                   'identifier' => 'main-menu_home:<front>',
                                                                   ),
                                                'module' => 'menu',
                                                'hidden' => 0,
                                                'external' => 1,
                                                'has_children' => 0,
                                                'expanded' => 0,
                                                'weight' => 0,
                                                'customized' => 1,
                                                );
  // Exported menu link: user-menu_login:user/login
  $menu_links['user-menu_login:user/login'] = array(
                                                    'menu_name' => 'user-menu',
                                                    'link_path' => 'user/login',
                                                    'router_path' => 'user/login',
                                                    'link_title' => 'Login',
                                                    'options' => array(
                                                                       'attributes' => array(
                                                                                             'title' => '',
                                                                                             ),
                                                                       'identifier' => 'user-menu_login:user/login',
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
  t('Login');
  t('home');

  return $menu_links;
}
