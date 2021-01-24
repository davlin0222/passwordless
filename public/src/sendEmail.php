<?php
header("Content-Type: application/json");

session_start();
$_SESSION["verificationCode"] = substr(md5(uniqid(rand(), true)), 0, 6);
$_SESSION["email"] = $_POST["email"];

$response = [
  "email" => $_SESSION["email"],
  "subject" => "Subject of email",
  "message" =>
    "Enter this verification code in browser \n Code: " .
    $_SESSION["verificationCode"],
];

echo json_encode($response);

// $response["email"] = "davlin@creatorise.com";
// mail($response["email"], $response["subject"], $response["message"]);
