<?php

/**
 * Implements hook_default_services_endpoint().
 */
function ckan_integration_endpoint_default_services_endpoint() {
	$export = array();

	$endpoint = new stdClass();
	$endpoint->disabled = FALSE; /* Edit this to true to make a default endpoint disabled initially */
	$endpoint->api_version = 3;
	$endpoint->name = 'xmlrpc';
	$endpoint->server = 'xmlrpc_server';
	$endpoint->path = 'services/xmlrpc';
	$endpoint->authentication = array();
	$endpoint->server_settings = array();
	$endpoint->resources = array(
		'session' => array(
			'operations' => array(
				'retrieve' => array(
					'enabled' => '1',
				),
			),
		),
		'druser' => array(
			'operations' => array(
				'retrieve' => array(
					'enabled' => '1',
				),
			),
		),
	);
	$endpoint->debug = 0;
	$export['xmlrpc'] = $endpoint;

	return $export;
}
