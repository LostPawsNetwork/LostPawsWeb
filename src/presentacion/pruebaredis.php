<?php

require_once "../config/redis.php";

$redis = getRedisConnection();

$key = "testKey";
$value = "Hello Redis!";
$redis->set($key, $value);

$retrievedValue = $redis->get($key);

echo "The value of '{$key}' is '{$retrievedValue}'.";
