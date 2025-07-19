<?php


class WebAPI
{
    public function __construct()
    {
        if (php_sapi_name() == "cli") {
        } else if (php_sapi_name() == "apache2handler") {
            global $__site_config;
            $__site_config = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../milkmateconfig.json');
        }
        DataBase::getConnection();
    }

    public function initiateSession()
    {
        //Session::Start();


    }
}
