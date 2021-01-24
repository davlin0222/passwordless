<?php
header("Content-Type: application/json");

session_start();
if ($_POST["verificationCode"] == $_SESSION["verificationCode"]) {
  $response = ["secret" => "secret"];
}

echo json_encode($response);
