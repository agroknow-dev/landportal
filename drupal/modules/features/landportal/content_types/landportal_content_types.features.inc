<?php
/**
 * @file
 * landportal_content_types.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function landportal_content_types_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function landportal_content_types_node_info() {
  $items = array(
    'blog_post' => array(
      'name' => t('Blog post'),
      'base' => 'node_content',
      'description' => t('A post in the Landportal Debate Blog'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'debate' => array(
      'name' => t('Debate'),
      'base' => 'node_content',
      'description' => t('A Land Debate. This content type is used to create a Debate on the Landportal website.
By default comments are enabled in Debates, the comments may be open or close regardless of the Debate status.
'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'event' => array(
      'name' => t('Event'),
      'base' => 'node_content',
      'description' => t('A concrete event (meeting, conference, show...) that will happen at a given time in a given place.'),
      'has_title' => '1',
      'title_label' => t('Event name'),
      'help' => '',
    ),
    'news' => array(
      'name' => t('News'),
      'base' => 'node_content',
      'description' => t('A temporal piece of information posted on the website used to inform people of a new publication, an interesting website to look at, something that will happen soon, etc...'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'organization' => array(
      'name' => t('Organization'),
      'base' => 'node_content',
      'description' => t('An organization (Private companies, NGOs, universities, associations...) referenced in the Landportal.'),
      'has_title' => '1',
      'title_label' => t('Organization Name'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}
