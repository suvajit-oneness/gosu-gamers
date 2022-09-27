<?php

// get the passed params
$plain_text_content = rawurldecode($_REQUEST['text']);
echo $plain_text_content . "<br>";

$text = str_replace(" ", "%20", $plain_text_content);
echo $text . "<br>";

//$text = rawurlencode($plain_text_content);
//$text = $_REQUEST['text'];
//$text = "Hello!";

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$to = $_REQUEST['to'];
$from = $_REQUEST['from'];

$url = "https://103.229.250.200/smpp/sendsms";

$final_url = $url . "?username=" . $username . "&password=" . $password . "&to=" . $to . "&from=" . $from . "&text=" . $text;
//echo $final_url;

//$msg1 = "Hi%20Nir,%20your%20OTP%20for%20login%20in%20LetsGameNow%20is%201234.%20Please%2enter%20to%20continue.";
//$final_url = "https://103.229.250.200/smpp/sendsms?username=lgnestapi&password=lgnestapi123&to=9830701260&from=LGNESP&text=$msg1";
//echo "<br><br>" . $final_url;
//die("<br><br>kill");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $final_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
$content = curl_exec($ch);
curl_close($ch);

echo $content;
echo $final_url;
