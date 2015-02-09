<?php
/**
 * @file
 * This module provide an interface to the landbook section of the Landportal.
 *
 * The Landportal landbook
 *
 * Original work by: WESO (http://www.weso.es/)
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landbook_block_info() {
  $blocks['country_sidebar_first']['info'] = t('Country maps and graphs');
  $blocks['country_sidebar_second']['info'] = t('Country selectors');
  $blocks['indicator_sidebar_second']['info'] = t('Indicator selectors');
  $blocks['regions_selectors']['info'] = t('Regions selector snippet');
  $blocks['share']['info'] = t('Share it');

  $translatables['book'][] = t('Country maps and graphs');
  $translatables['book'][] = t('Country selectors');
  $translatables['book'][] = t('Share it');

  return $blocks;
}

function landbook_block_view($delta = '') {
  switch ($delta) {
    case 'regions_selectors':
      $block = landbook_regions_selectors();
      break;
    case 'indicator_sidebar_second':
      $block = array('content' => 'indicator sidebar');
      break;
    case 'country_sidebar_first':
      $block = landbook_country_sidebar_first();
      break;
    case 'country_sidebar_second':
      $block = landbook_country_sidebar_second();
      break;
    case 'share':
      $block = array(
        '#theme' => 'item_list',
        '#items' => array('mail', 'twitter', 'linkedin', 'facebook'),
        'title' => t('Share'),
      );
      break;
  }
  return array('content', $block);
}


/* function landbook_block_view_alter(&$data, $block) { */
/*   //drupal_set_message($block->module); */
/*   if (is_array($data['content']) && $block->module == 'landbook') { */
/*     //theme('country-sidebar-first', array('data' => $data)); */
/*     dpm($data); */
/*     dpm($block); */
/*   } */
/* } */

/**
 * Block content helpers
 */
function landbook_regions_selectors($data=NULL) {
  global $language;
  if (!$data) return '';
  return theme('regions-selectors', array('data' => $data));
}

function landbook_country_sidebar_first($data=NULL) {
  global $language;
  if (!$data) return '';
  return theme('country-sidebar-first', array('data' => $data));
}
function landbook_country_sidebar_second($data=NULL) {
  global $language;
  if (!$data) return '';
  return theme('country-sidebar-second', array('data' => $data));
}

function landbook_indicator_sidebar_second($data=NULL) {
  global $language;
  if (!$data) return '';
  return theme('indicator-sidebar-second', array('data' => $data));
}


/**
 * Force landbook-menu block to display on landportal theme
 */
function landbook_block_info_alter(&$blocks, $theme, $code_blocks) {
  if ($theme == 'landportal') {
    $blocks['menu'][$GLOBALS['landbook_menu']]['status'] = TRUE;
    $blocks['menu'][$GLOBALS['landbook_menu']]['region'] = 'section_header';
    $blocks['menu'][$GLOBALS['landbook_menu']]['visibility'] = BLOCK_VISIBILITY_LISTED;
    $blocks['menu'][$GLOBALS['landbook_menu']]['pages'] = "book\nbook/*";

    $blocks['landbook']['share']['status'] = TRUE;
    $blocks['landbook']['share']['region'] = 'sidebar_second';
    $blocks['landbook']['share']['weight'] = 10;
    $blocks['landbook']['share']['visibility'] = BLOCK_VISIBILITY_LISTED;
    $blocks['landbook']['share']['pages'] = "book\nbook/countries/*";

    $blocks['landbook']['regions_selectors']['status'] = TRUE;
    $blocks['landbook']['regions_selectors']['region'] = 'sidebar_second';
    $blocks['landbook']['regions_selectors']['visibility'] = BLOCK_VISIBILITY_LISTED;
    $blocks['landbook']['regions_selectors']['pages'] = "book\nbook/regions*";

    $blocks['landbook']['country_sidebar_first']['status'] = TRUE;
    $blocks['landbook']['country_sidebar_first']['region'] = 'sidebar_first';
    $blocks['landbook']['country_sidebar_first']['visibility'] = BLOCK_VISIBILITY_LISTED;
    $blocks['landbook']['country_sidebar_first']['pages'] = "book/countries/*";

    $blocks['landbook']['country_sidebar_second']['status'] = TRUE;
    $blocks['landbook']['country_sidebar_second']['region'] = 'sidebar_second';
    $blocks['landbook']['country_sidebar_second']['weight'] = 1;
    $blocks['landbook']['country_sidebar_second']['visibility'] = BLOCK_VISIBILITY_LISTED;
    $blocks['landbook']['country_sidebar_second']['pages'] = "book/countries/*";

    $blocks['landbook']['indicator_sidebar_second']['status'] = TRUE;
    $blocks['landbook']['indicator_sidebar_second']['region'] = 'sidebar_second';
    $blocks['landbook']['indicator_sidebar_second']['weight'] = 1;
    $blocks['landbook']['indicator_sidebar_second']['visibility'] = BLOCK_VISIBILITY_LISTED;
    $blocks['landbook']['indicator_sidebar_second']['pages'] = "book/indicators/*";
  }
  return $blocks;
}
