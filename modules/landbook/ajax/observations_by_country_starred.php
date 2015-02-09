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
$language = (isset($_GET["language"]) ? $_GET["language"] : 'en');

header('Content-Type: application/json');
echo observations_by_country_starred($country1, $country2, $language);


function observations_by_country_starred($country1, $country2, $language){
    $cache = new CacheHelper('observations_by_country_starred', array(
        $country1,
        $country2,
        $language,
    ));
    $cached = $cache->get();
    if ($cached !== null) {
        return $cached;
    } else {
        $database = new DataBaseHelper();
        $database->open();
        $starred = _get_starred_indicators($database, $language);
        $result = _get_observations_by_starred($country1, $country2, $starred, $language, $database);
        $result = json_encode($result);
        $database->close();
        $cache->store($result);
        return $result;
    }
}

function _get_starred_indicators($database, $language) {
    $indicators = $database->query("starred_indicators", array($language));
    $result = array();
    for ($i = 0; $i < count($indicators); $i++) {
        array_push($result, $indicators[$i]["id"]);
    }
    return $result;
}


function _get_observations_by_starred($country1, $country2, $starred, $language, $database) {
    $result = array();
    foreach ($starred as $ind) {
        $observations = get_observations_by_country_indicator($country1, $country2,
            $ind, $language, $database);
        $result[$ind] = $observations;
    }
    return $result;
}
