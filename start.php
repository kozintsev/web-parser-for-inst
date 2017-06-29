<?
require_once('lib/curl_query.php');

$url = 'http://www.example.com';
$data = curl_get($url);
// Create a DOM object
$dom = new simple_html_dom();
// Load HTML from a string
$dom->load($data);

echo $data;
echo $dom;
