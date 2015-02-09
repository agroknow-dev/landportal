<?php
/**
 * @file
 * Provide data catalog display
 *
 * The Landportal landbook
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landbook_catalog($args=NULL) {
  landbook_add_js_vars($args);
  landbook_add_js_css();
  drupal_add_js(drupal_get_path('module', 'landbook').'/js/controller/catalog.js', array('scope'=>'footer'));
  return array(
    '#data'     => array(),
    '#type'     => 'markup',
    '#theme'    => 'catalog',
  );
}
