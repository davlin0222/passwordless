<?php
session_start();
session_destroy();

header("Content-Type: application/json");

$respons = ["success" => true, "message" => "Account logged out"];
echo $respons;
