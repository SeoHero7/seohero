<?php

include('simple_html_dom.php');

$q = "seo+hero";

$url = "https://www.google.com/search?q=".$q."&hl=en&start=0";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);

$html = str_get_html($response);

$urls = array();
foreach($html->find('p table tr td font[color=green]') as $element) {
	preg_match_all('!((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.\,]*(\?\S+)?)?)*)!', strip_tags($element), $match);
	$urls[] = $match[0][0];
}

foreach($urls as $key=>$url) {
	echo ($key+1).') '.$url.'<br />';
}
   

