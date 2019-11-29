<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'wcbYASYnOZ9dWKt8Nt2tmnXaD6tJtPnRMGrNBZ7L4J1fJR6fgZsNnGmCu5G7ZISnLXFi16+sWIj8NnyIwgpCXCAIVWnEL0nOtj0sMHPJR9Fc8DM1ceVzrC6r9TEjUrYcThIVU4vvHiwGL15tUE85lAdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '1c51653de6cd0f91323923fab0ffde9a';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

$jsonFlex = [
   "type" => "template",
    "altText" => "แบบประเมินความพึงพอใจการให้บริการ",
    "template" => [
      "type" => "carousel",
      "actions" => [],
      "columns" => [
        [
          "thumbnailImageUrl" => "https://sv1.picz.in.th/images/2019/11/22/gevr58.png",
          "title" => "แบบประเมินความพึงพอใจการให้บริการ",
          "text" => "ระดับความพึงพอใจ",
          "actions" => [
            [
              "type" => "postback",
              "label" => "1",
              "data" => "Data 1"
            ],
            [
              "type" => "postback",
              "label" => "2",
              "data" => "Data 2"
            ],
            [
              "type" => "postback",
              "label" => "3",
              "data" => "Data 3"
            ]
          ]
        ]
      ]
    ]
];

$string = $request_array["events"][0]["message"]["text"];
$word = "แจ้งเตือนการปิด CRQ";

//$postback = $request_array["events"][0]["actions"]["postback"];

if ( sizeof($request_array['events']) > 0 ) {
  if(strpos($string, $word) === FALSE) {
   foreach ($request_array['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  //Debug Detail message
            //'messages' => [['type' => 'text', 'text' => $text ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
    }
  }
  else {
    foreach ($request_array['events'] as $event) {
        error_log(json_encode($event));
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsonFlex]
        ];
        print_r($data);
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
