<?php
/**
 * @file
 * landportal_taxonomy.features.uuid_term.inc
 */

/**
 * Implements hook_uuid_features_default_terms().
 */
function landportal_taxonomy_uuid_features_default_terms() {
  $terms = array();

  $terms[] = array(
    'name' => 'Coming soon',
    'description' => '',
    'format' => 'filtered_html',
    'weight' => 0,
    'uuid' => 'a58ba1e1-c999-4a33-afc6-3da90c809b05',
    'vocabulary_machine_name' => 'debate_status',
  );
  $terms[] = array(
    'name' => 'Closed',
    'description' => '',
    'format' => 'filtered_html',
    'weight' => 1,
    'uuid' => 'ccdad97a-3a2e-4471-be00-b42852f5ed40',
    'vocabulary_machine_name' => 'debate_status',
  );
  $terms[] = array(
    'name' => 'Open',
    'description' => '',
    'format' => 'filtered_html',
    'weight' => 2,
    'uuid' => 'eb516755-6fc3-4c93-b75d-9108c3ee4258',
    'vocabulary_machine_name' => 'debate_status',
  );
  return $terms;
}
