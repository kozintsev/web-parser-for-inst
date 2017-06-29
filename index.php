<?
require_once('lib/curl_query.php');
require_once('lib/simple_html_dom.php');

$url = 'https://www.goodfon.ru/catalog/nature/';
$data = curl_get($url);
// Create a DOM object
$dom = new simple_html_dom();
// Load HTML from a string
$dom->load($data);

echo $data;
#echo $dom;
