<?php

include_once 'includes/Session.class.php';
include_once 'includes/User.class.php';
include_once 'includes/DataBase.class.php';
include_once 'includes/UserSession.class.php';
include_once 'includes/WebAPI.class.php';

Session::Start();
$wapi = new WebAPI();
$wapi->initiateSession();




function get_config($key, $default = null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}

function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT'] . "/Backend/_templates/$name.php"; //not consistant.
}

function validate_credentials($username, $password)
{
    if ($username == "santhosh@gmail.com" and $password == "password") {
        return true;
    } else {
        return false;
    }
}
