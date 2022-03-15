<?php

use \Source\Page;
use \Source\Support\Mailer;

$app->get('/', function () {

    $page = new Page();
    $page->setTpl("home");
});

$app->get('/sobre-nos', function () {

    $page = new Page();
    $page->setTpl("sobre-nos");
});

$app->get('/empresas-do-grupo', function () {

    $page = new Page();
    $page->setTpl("empresas-do-grupo");
});

$app->post('/enviarEmail', function () {

    extract($_POST);
    
    $mail = new Mailer($email, $name, utf8_decode("Formulário de Contato"), "email-sent", $_POST);

    if ($mail->send()) :
        $result = ["success" => 1, "msg" => "E-mail enviado com sucesso! Em breve entraremos em contato."];
    else :
        $result = ["success" => 0, "msg" => "Falha ao enviar e-mail."];
    endif;

    print(json_encode($result));
    exit;
});
