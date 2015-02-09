<?php
/**
 * @file
 * Provide data reuse display
 *
 * The Landportal landbook
 *
 * Original work by: WESO
 * Drupal refactoring: Jules <jules@ker.bz>
 */

function landbook_reuse($args=NULL) {
  global $language;
  // add some JS (from reuse.mustache)
  drupal_add_js("https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js", array('type'=>'external'));
  drupal_add_js("https://google-code-prettify.googlecode.com/svn/trunk/src/lang-sql.js", array('type'=>'external'));
  drupal_set_title('Linked Open Data store');
  landbook_add_js_vars();
  landbook_add_js_css();
  drupal_add_js(drupal_get_path('module', 'landbook').'/js/controller/reuse.js', array('scope' => 'footer'));
  $params = array(
    'language'          => $language->language,
    'sparql'            => $GLOBALS['landbook_urls']['sparql'],
    'querystring'       => $_GET,
   );
  $r = new Reuse();
  $data = $r->get($params);
  return array(
    '#data'     => $data,
    '#type'     => 'markup',
    '#theme'    => 'reuse',
  );
}


class Reuse {
	public function get($options) {
		$lang = $options['language'];
		$sparql = $options['sparql'];
		$querystring = $options['querystring'];

		$namespace = isset($querystring['default-graph-uri']) ? $querystring['default-graph-uri'] : 'http://book.landportal.org';
		$query = isset($querystring['query']) ? $querystring['query'] : '';
		$format = isset($querystring['format']) ? $querystring['format'] : '';

		$language = '';

		switch($format) {
			case 'text/html':
					$language = 'html';
					break;
			case 'application/vnd.ms-excel':
					$language = 'html';
					break;
			case 'application/sparql-results+xml':
					$language = 'xml';
					break;
			case 'json':
					$language = 'js';
					break;
			case 'application/javascript':
					$language = 'js';
					break;
			case 'text/plain':
					$language = 'xml';
					break;
			case 'application/rdf+xml':
					$language = 'xml';
					break;
			default:
					$language = 'html';
					break;
		}

		$result = '';
		$html = '';

		if ($query != '') {
			$query = urlencode($query);

			$url = $sparql . "?default-graph-uri=$namespace&query=$query&format=$format";
			$result = file_get_contents($url);

			$url = $sparql . "?default-graph-uri=$namespace&query=$query&format=text/html";
			$html = file_get_contents($url);

			//$html = str_replace('border="1"', 'border="0"', $html);
		}
		else
			$query = 'select distinct ?indicator where {[] a ?indicator} LIMIT 100';

		return array(
			'result' => $result,
			'html' => $html,
			'language' => $language,
			'query' => urldecode($query),
			'namespace' => $namespace
		);
	}
}
