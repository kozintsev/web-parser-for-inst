<?
require_once("lib/curl_query.php");
require_once("lib/simple_html_dom.php");

$host = "https://www.goodfon.ru";

$start_url = $host . "/catalog/nature/";
$html = curl_get($start_url);

$content = str_get_html($html);
// первая картинка /html/body/div[1]/div[11]/div/a вторая /html/body/div[1]/div[12]/div/a
$elems = $content->find("/html/body/div[1]/div[11]/div/a");
//<a href="/wallpaper/priroda-leto-pole-lavanda-solntse.html" title="Природа, лаванда, поле, солнце, лето"
foreach($elems as $a){
    $msg = $a->title; // текст пишем в инсаграмм пост
    $photo_name = str_replace('.html', '', $a->href);
    $photo_name = str_replace("/wallpaper/", '', $photo_name); // priroda-leto-pole-lavanda-solntse 
    $html = curl_get($host . $a->href, $start_url);
    //https://www.goodfon.ru/download/priroda-leto-pole-lavanda-solntse/1080x960/
    $html = curl_get($host . "/download/" . $photo_name . "/1080x960/", $host . $a->href);
    $c = str_get_html($html);
    $es = $c->find("//*[@id=\"im\"]/img");
    foreach($es as $e){
        $img_url = $e->src;
        echo $img_url;     
        $data = curl_get($img_url);
        $filename = uniqid() . ".jpg"; // имя файла которе будем отправлять
        file_put_contents($filename, $data);  

        unlink($filename); // удаляем файл после отправки
    }
    break;
}
