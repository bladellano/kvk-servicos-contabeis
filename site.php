<?php

use \Source\Page;
use \Source\Support\Mailer;

$app->get('/', function () {

    $page = new Page();
    $page->setTpl("home");
});

$app->get('/sobre-nos', function () {

    // die('Ola');

    $page = new Page();
    $page->setTpl("sobre-nos");
});