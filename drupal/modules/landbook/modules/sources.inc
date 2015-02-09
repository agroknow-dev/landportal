<?php
/**
 * @file
 * Provides data sources processing
 *
 * The Landportal landbook
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landbook_sources($args=NULL) {
  global $language;
  landbook_add_js_css();
  landbook_add_js_vars();

  if ($args) {
    $template = 'datasource';
    $r = new Datasource($language);
    $data = $r->get($language, $args);
    drupal_set_title($data['info']['name']);
  } else {
    $template = 'datasources';
    $r = new Datasources($language);
    $data = $r->get($language, $args);
  }

  drupal_add_js(drupal_get_path('module', 'landbook').'/js/controller/datasource.js', array('scope' => 'footer'));
  return array(
    '#theme'    => $template,
    '#data'     => $data,
  );
}

class Datasources {

  public function get($options) {
    $lang = $options->language;
    $cache = new CacheHelper('datasources', array(
      $lang,
    ));
    $cached = $cache->get();
    if ($cached !== null) {
      return $cached;
    } else {
      $database = new DataBaseHelper();
      $database->open();
      $datasources = $database->query("organizations", array());
      $database->close();
      $result = $this->compose_data($datasources);
      $cache->store($result);
      return $result;
    }
  }

  private function compose_data($datasources) {
    return array(
      "data-sources" => $this->compose_datasources($datasources)
    );
  }

  private function compose_datasources($data) {
    $result = array();
    for ($i = 0; $i < count($data); $i++) {
      $datasource = array(
        "id" => $data[$i]["id"],
        "name" => utf8_encode($data[$i]["name"]),
        "url" => $data[$i]["url"]
      );
      array_push($result, $datasource);
    }
    return $result;
  }
}

class Datasource {

  public function get($options, $source_id) {
    $lang = $options->language;
    $cache = new CacheHelper('datasource', array(
      $source_id,
      $lang,
    ));
    $cached = $cache->get();
    if ($cached !== null) {
      return $cached;
    } else {
      $database = new DataBaseHelper();
      $database->open();
      $safe_datasource_id = $database->escape($source_id);
      $lang = $database->escape($lang);
      $organization = $database->query("organization", array($safe_datasource_id, $lang));
      if (!$organization) {
        drupal_set_message($organization.' not found');
        // drupal_goto("e404");
      }
      $indicators = $database->query("indicators_by_organization", array($lang, $safe_datasource_id));
      $organizations = $database->query("organizations", array());
      $database->close();
      $result = $this->compose_data($organization, $indicators, $organizations);
      $cache->store($result);
      return $result;
    }
  }

  private function compose_data($organization, $indicators, $organizations) {
    return array(
      "info" => $this->compose_info($organization),
      "selectors" => array(
        "data-sources" => $this->compose_datasources($organizations),
        "indicators" => $this->compose_indicators($indicators),
      )
    );
  }

  private function compose_info($data) {
    return array(
      "id" => $data[0]["id"],
      "name" => utf8_encode($data[0]["name"]),
      "url" => $data[0]["url"],
      "description" => utf8_encode($data[0]["description"])
    );
  }

  private function compose_datasources($data) {
    $result = array();
    for ($i = 0; $i < count($data); $i++) {
      $datasource = array(
        "id" => $data[$i]["id"],
        "name" => utf8_encode($data[$i]["name"]),
        "url" => $data[$i]["url"]
      );
      array_push($result, $datasource);
    }
    return $result;
  }

  private function compose_indicators($data) {
    $result = array();
    for ($i = 0; $i < count($data); $i++) {
      $indicator = array(
        "id" => $data[$i]["id"],
        "name" => utf8_encode($data[$i]["name"]),
        "description" => utf8_encode($data[$i]["description"]),
        "format" => $data[$i]["measurement_unit"],
        "last_update" => $data[$i]["last_update"]
      );
      array_push($result, $indicator);
    }
    return $result;
  }
}
