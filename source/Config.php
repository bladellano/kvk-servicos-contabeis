<?php
// 
define("URL_BASE", "http://127.0.0.1/kvk-servicos-contabeis/");

define("YEAR", date('Y'));

// Email configuration
define("MAIL_EMAIL", "contato@kvkcontabeis.com.br");
define("MAIL_PASSWORD", "H15032022e@");
define("MAIL_HOST", "mail.kvkcontabeis.com.br");
define("MAIL_NAME_FROM", "Portal Kvk");

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

function url(string $path): string
{
    if ($path)
        return URL_BASE . $path;
    return URL_BASE;
}

function message(string $message, string $type): string
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
