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
$datetimenow = date("YmdHis");
$mass = $datetimenow.','.$user_id.','.$name_.','.$pic_;
//.','.$postback;
$masscheck = $name_.','.$pic_;
  
if ( sizeof($request_array['events']) > 0 ) {
  if($user_id !== 'Ubbf112e041afc53cf84061c42561a5e3' || $user_id !== 'Ub257e0ce1beef10a865e9809bf639be5') {
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
            ['type' => 'text', 'text' => 'สวัสดีครับคุณ '.$name_.' ('.$user_id.' )' ],
            ['type' => 'text', 'text' => 'รับเรื่องไว้แล้วครับ'."\r\n".'ขออนุญาตให้เจ้าหน้าที่ติดต่อกลับ'."\r\n".'จ.-ศ.เวลา9.00-17.30น.' ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
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
