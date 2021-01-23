<?php
header("Content-Type: application/json");

$response = [
  "email" => $_POST["email"],
  "subject" => "Subject of email",
  "message" => "This is the message",
];

echo json_encode($response);

$response["email"] = "davlin@creatorise.com";
mail($response["email"], $response["subject"], $response["message"]);
