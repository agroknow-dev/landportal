<?php
/**
 * @file
 * Main Landportal theme file
 *
 * The Landportal theme for Drupal 7.x
 *
 * Original work by: WESO (http://www.weso.es/)
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landportal_theme($existing, $type, $theme, $path) {
  $items = array();
  return $items;
}

/**
 * The right place to add common css & js for all pages
 */
function landportal_preprocess_html(&$variables) {
  drupal_add_css(
    "http://fonts.googleapis.com/css?family=News+Cycle|Source+Sans+Pro:300,400|Josefin+Sans:300",
    array('type' => 'external')
  );
  //drupal_add_js(drupal_get_path('module', 'landbook').'/js/libraries/bootstrap.min.js');
  drupal_add_css(drupal_get_path('theme', 'landportal').'/css/font-awesome.min.css');
  drupal_add_css(drupal_get_path('theme', 'landportal').'/css/bootstrap.min.css');

  $meta_viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'content' => 'width=device-width',
      'name' => 'viewport',
    )
  );
  drupal_add_html_head($meta_viewport, 'viewport');

}

/**
 * Add description to section-header menus
 * If no menu are found in the section-header remove the whole block
 */
function landportal_page_alter(&$page) {
  if (!isset($page['section_header'])) return;
  $check = FALSE;
  foreach (array('landbook', 'landdebate', 'landlibrary') as $i) {
    if (isset($page['section_header']['menu_' . $i . '-menu'])) {
      $m = menu_load($i . '-menu');
      $page['section_header']['menu_'. $i . '-menu']['#block']->description = $m['description'];
      $check = TRUE;
    }
  }
  if (!$check) unset($page['section_header']);
}
