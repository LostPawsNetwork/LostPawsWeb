<?php
#sale de config y src y entra a la carpeta vendor (en docker)
require "../../vendor/autoload.php";

function getRedisConnection()
{
    $redis = new Predis\Client([
        "scheme" => "tcp",
        "host" => "redis",
        "port" => 6379,
    ]);
    return $redis;
}
