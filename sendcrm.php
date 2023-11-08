<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pipeline_id = 1; // ідентифікатор воронки (за відсутності параметра буде використана перша воронка у списку)
$manager_id = 7; //ідентифікатор відповідального менеджера 7 - Елена Шаронова
$source_id = 46; // ID источника
$title = '[QA USA для GIX_PPC] '.$_POST['name']; // назва заявки

$data = [
  "title" => $title,
  "source_id" => $source_id,
  "manager_id" => $manager_id,
  "pipeline_id" => $pipeline_id,
  "contact" => [
      "full_name" => $name, // ПІБ покупця
      "email" => $email, // email покупця
      "phone" => $phone // номер телефону покупця
  ],

  "custom_fields" => [
    [ 
        "uuid" => "LD_1006",
        "value" => $_SERVER['HTTP_REFERER']
    ]
  ]

];


if (isset($_SERVER['HTTP_REFERER'])) {
      $sourceUrl = $_SERVER['HTTP_REFERER'];
      $sourceUrlParts = parse_url($sourceUrl);
      if (isset($sourceUrlParts['query'])) {
            parse_str($sourceUrlParts['query'], $query);

            $data['utm_source'] = isset($query['utm_source']) ? $query['utm_source'] : '';
            $data['utm_medium'] = isset($query['utm_medium']) ? $query['utm_medium'] : '';
            $data['utm_term'] = isset($query['utm_term']) ? $query['utm_term'] : '';
            $data['utm_content'] = isset($query['utm_content']) ? $query['utm_content'] : '';
            $data['utm_campaign'] = isset($query['utm_campaign']) ? $query['utm_campaign'] : '';
      }
}

//var_dump($data);die;

//  "упаковуємо дані"
$data_string = json_encode($data);

// Ваш унікальний API ключ KeyCRM
$token = 'YzU3MGNmODY1ZjBkZDliOTZhYzY4Zjc1YmFhYzM4MWYyMTEwYmY2Yw';

// відправляємо на сервер
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://openapi.keycrm.app/v1/pipelines/cards");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-type: application/json",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        'Authorization:  Bearer ' . $token)
);
$result = curl_exec($ch);
curl_close($ch);


header('Location: https://qa.skillupforua.com/quality_assurance_usa/thankyou/');

?>