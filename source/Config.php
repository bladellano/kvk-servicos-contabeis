<?php

define("URL_BASE","http://grupokvk.local.com/");

define("YEAR",date('Y'));

// Email configuration
define("MAIL_EMAIL","contato@sociedadenovomilenium.com.br");
define("MAIL_PASSWORD","iL5pb2?6");
define("MAIL_HOST","sociedadenovomilenium.com.br");
define("MAIL_NAME_FROM","Gerenciador de Conteúdo");

// Database configuration
define("DB_SITE", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "db_ecommerce_editado",
    "username" => "root",
    "passwd" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

// All functions

function url(string $path):string
{
    if($path)
        return URL_BASE. $path;
    return URL_BASE;
}

function message (string $message, string $type): string
{
    return "<div class=\"message {$type}\">{$message}</div>";
}

function toDatePtBr($date)
{
    $DateTime = new DateTime($date);
    return $DateTime->format("d/m/Y H:i:s");
}

function resume($string, $chars) 
{
    return mb_strimwidth($string, 0, $chars + 3, "...");
}