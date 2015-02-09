<?php
/**
 * @file
 * This file provide context(ual) implementation for the landdebate section header
 *
 * The Landportal landdebate
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landdebate_context_default_context() {
  $conditions = array('node' => array('values' => array()), 'options' => array('node_form' => '0'));
  foreach (array_keys($GLOBALS['landdebate_content_types']) as $ct) {
    $conditions['node']['values'][$ct] = $ct;
  }

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'debate-menu-context';
  $context->description = 'Contextually display landdebate section header menu';
  $context->tag = '';
  $context->conditions = $conditions;
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'menu-landdebate-menu' => array(
          'module' => 'menu',
          'delta' => 'landdebate-menu',
          'region' => 'section_header',
          'weight' => '1',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;
  return array('landdebate-menu-context' => $context);
}
