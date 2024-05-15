<?php
require_once "../../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$secretKey = $_ENV["SECRET_KEY"];

$recaptchaResponse = $_POST["g-recaptcha-response"];

$recaptcha = new \ReCaptcha\ReCaptcha($secretKey);
$resp = $recaptcha->verify($recaptchaResponse, $_SERVER["REMOTE_ADDR"]);

if ($resp->isSuccess()) {
    header("Location: ../presentacion/prueba.php");
} else {
    $errors = $resp->getErrorCodes();
    header("Location: ../presentacion/login.php?error=" . $errors[0]);
}
?>
