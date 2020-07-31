<?php
session_start();
//require_once("userClass.php");

require '..\vendor\autoload.php';
require '../config.class.php';

parse_str(http_build_query($_POST), $post);
parse_str($post['data']);

$configParms = new Config();
$dbConfig = $configParms->get('db');
parse_str(http_build_query($dbConfig));

$db = new Mysqlidb ($host, $user, $pwd, $database);

$md5Pass = md5($spass);

$db->where('user_name', $semail);
$db->where('user_password', $md5Pass);
$access = $db->getOne('access');
$q = "SELECT * FROM access WHERE user_name = '".$semail."' AND user_password = '".$md5Pass."'";

$user = $db->rawQuery($q);

//print_r($user);

parse_str(http_build_query($user[0]));

$_SESSION['user_id'] = $user_id;
$_SESSION['user_realname'] = $user_realname;
$_SESSION['userObject'] = serialize($user_name);
$_SESSION['authenticated'] = $semail;



die("success");


