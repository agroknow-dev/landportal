<?php
/**
 * @file
 * Landbook menu
 *
 * The Landportal landbook
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landbook_menu_build(&$items) {

  // Landbook main-menu link
  $items['book/<front>'] = array(
    'title'		=> 'Home',
    'menu_name'		=> $GLOBALS['landbook_menu'],
    'type'              => MENU_NORMAL_ITEM,
    'access callback'	=> TRUE,
    'page callback'	=> 'drupal_goto',
    'page arguments'    => array('<front>'),
  );
  $translatables['book'][] = t('Home');

  foreach ($GLOBALS['landbook_sections'] as $i=>$s) {
    $items['book/' . $s] = array(
      'title'           => ucfirst($s),
      'menu_name'       => $GLOBALS['landbook_menu'],
      'access callback'	=> TRUE,
      'weight'          => $i,
      'type'            => MENU_NORMAL_ITEM,
      'page callback'   => 'landbook_' . $s,
      //'page arguments'  => array(),
      'file'            => $s . '.inc',
      'file path'       => drupal_get_path('module', 'landbook').'/modules',
    );

    $items['book/' . $s . '/%'] = array(
      'title'           => preg_replace('/s$/', '', str_replace('ies', 'y', $s)),
      'access callback'	=> TRUE,
      'page callback'   => 'landbook_' . $s,
      'page arguments'  => array(2),
      'file'            => $s . '.inc',
      'file path'       => drupal_get_path('module', 'landbook').'/modules',
    );

    $translatables['book'][] = t($items['book/' . $s]['title']);
    $translatables['book'][] = t($items['book/' . $s . '/%']['title']);
  }

  // Add country details page hook
  $items['book/countries/%/details'] = array(
    'title'           => 'All available indicators for',
    'access callback'	=> TRUE,
    'page callback'   => 'landbook_countries_details',
    'page arguments'  => array(2),
    'file'            => 'countries.inc',
    'file path'       => drupal_get_path('module', 'landbook').'/modules',
  );
  $translatables['book'][] = t('All available indicators for');
}

function landbook_menu_admin(&$items) {
  // Admin section
  $items['admin/config/landbook'] = array(
    'title'             => 'Landbook',
    'description'       => 'Configure the landbook',
    'postition'         => 'right',
    'weight'            => -4,
    'page callback'	=> 'system_admin_menu_block_page',
    'access arguments'  => array('administer site configuration'),
    'file'              => 'system.admin.inc',
    'file path'         => drupal_get_path('module', 'system'),
  );
  $items['admin/config/landbook/settings'] = array(
    'title'             => 'Landbook settings',
    'description'       => 'Base landbook configuration',
    'page callback'	=> 'drupal_get_form',
    'page arguments'	=> array('landbook_admin_settings'),
    'access arguments'  => array('administer site configuration'),
    'file'              => 'landbook.admin.inc',
    'file path'         => drupal_get_path('module', 'landbook').'/includes'
  );
}
