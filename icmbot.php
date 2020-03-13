<?php
date_default_timezone_set("Asia/Bangkok");

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'wcbYASYnOZ9dWKt8Nt2tmnXaD6tJtPnRMGrNBZ7L4J1fJR6fgZsNnGmCu5G7ZISnLXFi16+sWIj8NnyIwgpCXCAIVWnEL0nOtj0sMHPJR9Fc8DM1ceVzrC6r9TEjUrYcThIVU4vvHiwGL15tUE85lAdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '1c51653de6cd0f91323923fab0ffde9a';

$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

$user_id = $request_array["events"][0]["source"]["userId"];
$opts = [
  "http" =>[
  "header" => "Content-Type: application/json\r\n".'Authorization: Bearer ' . $ACCESS_TOKEN
  ]
  ];
  $context = stream_context_create($opts);
  $profile_json = file_get_contents('https://api.line.me/v2/bot/profile/'.$user_id,false,$context);
  $profile_array = json_decode($profile_json,true);
  $pic_ = $profile_array["pictureUrl"];
  $name_ = $profile_array["displayName"];
  
$string = $request_array["events"][0]["message"]["text"];
// $word = "แจ้งเตือนการปิด CRQ";
  
// $postback = $request_array["events"][0]["postback"]["data"];
//$datetimenow = date("YmdHis");
$timenow = date("H:i:s");
$datenow = date("D");
//$mass = $datetimenow.','.$user_id.','.$name_.','.$pic_;
//.','.$postback;
//$masscheck = $name_.','.$pic_;

//if ( sizeof($request_array['events']) > 0 )

// Ucdc26501d7b5faa84729b2dff39be93c = Support00
// U88a81b4f2ac8567a6a7fa2720a2319dc = Support02
// Ubbf112e041afc53cf84061c42561a5e3 = Support04
// Ub257e0ce1beef10a865e9809bf639be5 = Support06
// Uf4a6346462b6134e9dc7508e87976386 = PMC
// Uffa42b3f8ea958a02cd4f89bb9dfd49c = P'Noi

if (sizeof($request_array['events'][0]['message']) > 0 || sizeof($request_array['events'][0]['sticker']) > 0 ) {
  if($user_id == 'Ucdc26501d7b5faa84729b2dff39be93c' || $user_id == 'U88a81b4f2ac8567a6a7fa2720a2319dc' 
  || $user_id == 'Ubbf112e041afc53cf84061c42561a5e3' || $user_id == 'Ub257e0ce1beef10a865e9809bf639be5' 
  || $user_id == 'Uf4a6346462b6134e9dc7508e87976386' || $user_id == 'Uffa42b3f8ea958a02cd4f89bb9dfd49c') {
    //Do Nothing
  }else{
    if($datenow == "Sat" || $datenow == "Sun"){
      foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            //'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  //Debug Detail message
            'messages' => [['type' => 'sticker', 'packageId' => '11537', 'stickerId' => '52002738' ],
            // ['type' => 'text', 'text' => $text ],
            // ['type' => 'text', 'text' => $user_id.','.$name_ ]]
            ['type' => 'text', 'text' => 'สวัสดีครับ' ],
            ['type' => 'text', 'text' => 'รับเรื่องไว้แล้วครับ'."\r\n".'ขออนุญาตให้เจ้าหน้าที่ติดต่อกลับ'."\r\n".'จ.-ศ.เวลา9.00-17.30น.' ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
      }
    }elseif($timenow >= "12:01:00" && $timenow <= "12:59:59"){
      foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            //'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  //Debug Detail message
            'messages' => [['type' => 'sticker', 'packageId' => '11537', 'stickerId' => '52002738' ],
            // ['type' => 'text', 'text' => $text ],
            // ['type' => 'text', 'text' => $user_id.','.$name_ ]]
            ['type' => 'text', 'text' => 'สวัสดีครับ' ],
            ['type' => 'text', 'text' => 'รับเรื่องไว้แล้วครับ'."\r\n".'ขออนุญาตให้เจ้าหน้าที่ติดต่อกลับ'."\r\n".'เวลา 13.00น.' ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
      }
    }elseif($timenow >= "18:01:00" && $timenow <= "23:59:59"){
      foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            //'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  //Debug Detail message
            'messages' => [['type' => 'sticker', 'packageId' => '11537', 'stickerId' => '52002738' ],
            // ['type' => 'text', 'text' => $text ],
            // ['type' => 'text', 'text' => $user_id.','.$name_ ]]
            ['type' => 'text', 'text' => 'สวัสดีครับ' ],
            ['type' => 'text', 'text' => 'รับเรื่องไว้แล้วครับ'."\r\n".'ขออนุญาตให้เจ้าหน้าที่ติดต่อกลับ'."\r\n".'จ.-ศ.เวลา9.00-17.30น.' ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
      }
    }elseif($timenow >= "00:00:00" && $timenow <= "08:44:59"){
      foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            //'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  //Debug Detail message
            'messages' => [['type' => 'sticker', 'packageId' => '11537', 'stickerId' => '52002738' ],
            // ['type' => 'text', 'text' => $text ],
            // ['type' => 'text', 'text' => $user_id.','.$name_ ]]
            ['type' => 'text', 'text' => 'สวัสดีครับ' ],
            ['type' => 'text', 'text' => 'รับเรื่องไว้แล้วครับ'."\r\n".'ขออนุญาตให้เจ้าหน้าที่ติดต่อกลับ'."\r\n".'จ.-ศ.เวลา9.00-17.30น.' ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
      }
    }else{
      //Do Nothing
      // foreach ($request_array['events'] as $event) {
      //   $reply_message = '';
      //   $reply_token = $event['replyToken'];
      //   $text = $event['message']['text'];
      //   $data = [
      //       'replyToken' => $reply_token,
      //       'messages' => [['type' => 'text', 'text' => 'Do Nothing ('.$datenow.' - '.$timenow.')'."\r\n".$name_.' ('.$user_id.')' ]]
      //       // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ],  //Debug Detail message
      //       // ['type' => 'text', 'text' => 'สวัสดีครับคุณ '.$name_.' ('.$user_id.')'."\r\n".$datenow.' - '.$timenow ],
      //       // ['type' => 'text', 'text' => "$reply_message\r\n$reply_token\r\n$text\r\n$data" ]]
      //   ];
      //   $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
      //   $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
      //   echo "Result: ".$send_result."\r\n";
      // }
    }
  }
}
echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
