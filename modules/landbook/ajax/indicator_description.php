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

$indicator_id = $_GET["indicator"];
$language = (isset($_GET["language"]) ? $_GET["language"] : 'en');

header('Content-Type: application/json');
echo indicator_description($indicator_id, $language);


function indicator_description($indicator_id, $language) {
    $database = new DataBaseHelper();
    $database->open();
    $indicator_id = $database->escape($indicator_id);
    $language = $database->escape($language);

    $description = $database->query("indicator_description", array($language, $indicator_id));
    if (count($description) > 0) {
        return json_encode(array("description" => $description[0]["description"]));
    }
    return json_encode(array("description" => ""));
}
