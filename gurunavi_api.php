<?php
$base_url = "http://api.gnavi.co.jp/";
$api_name = "RestSearchAPI/20150630/";

$config = json_decode(file_get_contents('./config.json'));
$keyid    = $config->api->keyid;
$format   = $config->api->format;

$url = $base_url . $api_name . "?keyid=" . $keyid . "&format=" . $format;

$json = file_get_contents($url, true) or die("Failed to get json");
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$obj = json_decode($json);

var_dump($obj);
