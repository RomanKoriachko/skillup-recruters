<?php

// ob_start();
// echo "_GET".PHP_EOL;
// print_r($_GET);
// echo "_POST".PHP_EOL;
// print_r($_POST);
// echo "_SERVER".PHP_EOL;
// print_r($_SERVER);
// $desc = ob_get_clean();
// file_put_contents(__DIR__."/send.log", $desc, FILE_APPEND | LOCK_EX);

// Check if query contains required parameters
if (!isset($_POST["name"]) || !isset($_POST["phone"]) || !isset($_POST["email"])) {
    echo "die";
    die;
}

$_POST["name"] = trim($_POST["name"]);
$_POST["phone"] = trim($_POST["phone"]);
$_POST["email"] = trim($_POST["email"]);

$assigned_by_id = 12681; //это ИД человека, на которого будет закреплен лид!
$title = '[С сайта LP QA USA для GIX_PPC] '.$_POST['name'];
$name = $_POST['name'];
$tel = $_POST['phone'];
$email = $_POST['email'];
$SOURCE_ID= "461";



$gacid = $_COOKIE ['_ga']; 
$str = $gacid;
$gacid = substr(strstr($str, '.2.'), 1, strlen($str));
$str = $gacid;
$gacid = substr(strstr($str, '.'), 1, strlen($str));


if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //echo "E-mail адрес '$email_b' указан верно.\n";
} else {
    $email = '';
}

// Parse utm
$utm = array(
  'utm_source' => '',
  'utm_medium' => '',
  'utm_term' => '',
  'utm_content' => '',
  'utm_campaign' => ''
);
if (isset($_SERVER['HTTP_REFERER'])) {
  $surceUrl = $_SERVER['HTTP_REFERER'];
  $surceUrlParts = parse_url($surceUrl);
  if (isset($surceUrlParts['query'])) {
    parse_str($surceUrlParts['query'], $query);

    $utm['utm_source'] = isset($query['utm_source']) ? $query['utm_source'] : '';
    $utm['utm_medium'] = isset($query['utm_medium']) ? $query['utm_medium'] : '';
    $utm['utm_term'] = isset($query['utm_term']) ? $query['utm_term'] : '';
    $utm['utm_content'] = isset($query['utm_content']) ? $query['utm_content'] : '';
    $utm['utm_campaign'] = isset($query['utm_campaign']) ? $query['utm_campaign'] : '';
  }
}

$url = 'https://skillup.bitrix24.eu/rest/4436/l32mfl80x30z0wca/crm.lead.add.json'; //4436 - это ИД пользователя с правами только на создание лида. Не менять!

$params = array(
'fields' => array(
	'TITLE' => $title,
	'NAME' => $name,
	'PHONE' => array(array("VALUE" => $tel, "VALUE_TYPE" => "WORK" )),
	'EMAIL' => array(array("VALUE" => $email, "VALUE_TYPE" => "WORK" )),
	'ASSIGNED_BY_ID' => $assigned_by_id,
  'UF_CRM_1468941026' => $utm['utm_source'],
  'UF_CRM_1468941195' => $utm['utm_campaign'],
  'UF_CRM_1468941211' => $utm['utm_medium'],
  'UF_CRM_1533723074' => $utm['utm_term'],
  'UF_CRM_1533723110' => $utm['utm_content'],
	'SOURCE_ID' => $SOURCE_ID,
  'UF_CRM_1514382622' => $_SERVER['HTTP_REFERER'],
  'UF_CRM_1536249221' => $gacid));
  
  
  

$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($params)
    )
)));



header('Location: https://qa.skillupforua.com/quality_assurance_usa/thankyou/');

?>





