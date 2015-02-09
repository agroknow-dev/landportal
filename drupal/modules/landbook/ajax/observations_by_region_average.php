<?php
/**
 * @file
 * This file provides JSON data for the landbook JS
 *
 * This file is not process through Drupal
 *
 * The Landportal landbook
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

require_once(dirname(__FILE__) .'/../../../local.settings.php');
require_once(dirname(__FILE__) .'/../../../dbconfig.php');
require_once(dirname(__FILE__) .'/../utils/database_helper.php');
require_once(dirname(__FILE__) .'/../utils/cache_helper.php');

$region1 = $_GET["region1"];
$region2 = isset($_GET["region2"]) ? $_GET["region2"] : "";
$indicator = $_GET["indicator"];
$language = (isset($_GET["language"]) ? $_GET["language"] : 'en');

header('Content-Type: application/json');
echo observations_by_region_average($region1, $region2, $indicator, $language);

/**
 * Calculate the observations average for a certain region or regions and an
 * indicator.
 * @param $region1 UN_CODE for the region to calculate is average.
 * @param $region2 UN_CODE for the other region to calculate is average.  This
 *    parameter may be empty.
 * @param $indicator ID of the indicator for use in the comparison.
 * @param $language Language to show the regions name.
 *
 * @return Json array with two objects 'series' and 'times'.  'Series' contains
 *    the regions ID, name and values.  'Times' contains the years used for
 *    the compairson.
 */
function observations_by_region_average($region1, $region2, $indicator, $language) {
    $cache = new CacheHelper("observations_by_region_avg", array(
      $region1,
      $region2,
      $indicator,
      $language,
    ));
    $cached = $cache->get();
    if ($cached !== null) {
      //var_dump($cached);
        return $cached;
    }
    $database = new DataBaseHelper();
    $database->open();

    $region1 = $database->escape($region1);
    $region2 = $database->escape($region2);
    $indicator = $database->escape($indicator);

    $regionFilter = $region1 == 1 ? "" : "AND regions.un_code = $region1";
    $averages = $database->query("observations_by_region_avg", array($regionFilter, $indicator));
    $result1 = compose_data($averages);
    $reg1 = $database->query("continent_name", array($language, $region1));
    $region1Name = utf8_encode($reg1[0]["name"]);

    $result2 = NULL;
    $region2Name = "";
    if ($region2 != "") {
      $regionFilter = $region2 == 1 ? "" : "AND regions.un_code = $region2";
      $averages = $database->query("observations_by_region_avg", array($regionFilter, $indicator));
      $result2 = compose_data($averages);
      $reg2 = $database->query("continent_name", array($language, $region2));
      $region2Name = utf8_encode($reg2[0]["name"]);
    }
    $database->close();
    $result = json_encode(mergeRegions($region1, $region1Name, $result1, $region2, $region2Name, $result2));
    $cache->store($result);
    return $result;
}

function mergeRegions($region1, $region1Name, $regionData1, $region2, $region2Name, $regionData2) {
  $times = $regionData2 == NULL ? $regionData1["times"] :
            array_merge($regionData1["times"], $regionData2["times"]);

  $times = array_values(array_unique($times));
  asort($times);

  $series = array($region1 => array("name" => $region1Name, "values" => array()));

  $data = $regionData1["result"];

  for ($i = 0; $i < count($times); $i++) {
    $time = $times[$i];

    array_push($series[$region1]["values"], isset($data[$time]) ? $data[$time]["average"] : NULL);
  }

  if ($regionData2 != NULL) {
    $series[$region2] = array("name" => $region2Name, "values" => array());

    $data = $regionData2["result"];

    for ($i = 0; $i < count($times); $i++) {
      $time = $times[$i];

      array_push($series[$region2]["values"], isset($data[$time]) ? $data[$time]["average"] : NULL);
    }
  }

  return array("series" => $series, "times" => array_values($times));
}

/**
 * Composes the results from the DB
 * @return An array with all the results for the views.  This array can be json-encoded and sent
 */
function compose_data($averages) {
  $result = array();

  $times = array();

  for ($i = 0; $i < count($averages); $i++) {
    $time = $averages[$i]["ref_time"];

    $average = array(
      "average" => (float)$averages[$i]["value"],
      "time" => $time,
    );

    $result[$time] = $average;

    if (!array_search($time, $times))
      array_push($times, $time);
  }

  return array("result" => $result, "times" => $times);
}


/**
 * Gets a pre-cached result.
 * @return The result or null if it was not cached before.
 */
function get_from_cache($region1, $region2, $indicator, $language) {
  $key = generate_cache_key($region1, $region2, $indicator, $language);
  if (function_exists("apc_exists") && apc_exists($key) !== false)
    return apc_fetch($key);
  return null;
}


/**
 * Generates a unique key to store the result into the cache.
 * @return md5 hash to use as cache-key
 */
function generate_cache_key($region1, $region2, $indicator, $language) {
    return hash('md5', "observations_by_region_avg"
        . $region1
        . $region2
        . $indicator
        . $language
    );
}
