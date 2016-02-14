<?php
$base_url = "http://api.gnavi.co.jp/";
$api_name = "RestSearchAPI/20150630/";

$config = json_decode(file_get_contents('./config.json'));
$keyid    = $config->api->keyid;
$format   = $config->api->format;

$keywords = json_decode(file_get_contents('./keyword.json'));
foreach ($keywords as $keyword) {
  $url = $base_url . $api_name . "?keyid=" . $keyid . "&format=" . $format . "&areacode_l=AREAL6150&freeword=" . urlencode($keyword);

  $json = file_get_contents($url, true) or die("Failed to get json");
  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $obj = json_decode($json);

  print($keyword . ": " . $obj->total_hit_count . PHP_EOL);
  if ($obj->total_hit_count > 0) {
    if ($obj->total_hit_count > 1) {
      foreach ($obj->rest as $rest) {
        var_dump($rest->name);
        var_dump($rest->image_url->shop_image1);
        var_dump($rest->pr->pr_short);
        var_dump($rest->pr->pr_long );
        var_dump($rest->address   );
        var_dump($rest->tel       );
        var_dump($rest->latitude  );
        var_dump($rest->longitude );
        print(PHP_EOL);
      }
    } else {
      var_dump($obj->rest->name);
      var_dump($obj->rest->image_url->shop_image1);
      var_dump($obj->rest->pr->pr_short);
      var_dump($obj->rest->pr->pr_long );
      var_dump($obj->rest->address   );
      var_dump($obj->rest->tel       );
      var_dump($obj->rest->latitude  );
      var_dump($obj->rest->longitude );
      print(PHP_EOL);
    }
  } else {
    print($obj->error->message . PHP_EOL . PHP_EOL);
  }
}
