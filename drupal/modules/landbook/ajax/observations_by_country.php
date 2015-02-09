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
require_once(dirname(__FILE__) ."/../utils/observations_by_country_indicator.php");

$country1 = $_GET["country1"];
$country2 = $_GET["country2"];
$indicator = $_GET["indicator"];
$language = (isset($_GET["language"]) ? $_GET["language"] : 'en');

header('Content-Type: application/json');
echo observations_by_country($country1, $country2, $indicator, $language);




function observations_by_country($country1, $country2, $indicator, $language) {
    $cache = new CacheHelper('observations_by_country', array(
        $country1,
        $country2,
        $indicator,
        $language,
    ));
    $cached = $cache->get();
    if ($cached !== null) {
        return $cached;
    } else {
        $database = new DataBaseHelper();
        $database->open();
        $country1 = $database->escape($country1);
        $country2 = $database->escape($country2);
        $indicator = $database->escape($indicator);
        $result = get_observations_by_country_indicator($country1, $country2, $indicator, $language, $database);
        $json_result = json_encode($result);
        $cache->store($json_result);
        $database->close();
        return $json_result;
    }
}
