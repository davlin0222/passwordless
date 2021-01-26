<?php
session_start();
header("Content-Type: application/json");

if ($_GET["updateAccountSecret"]) {
  $response = updateAccountSecret($_POST["accountSecret"]);
} else {
  $response = [
    "success" => false,
    "message" => "No valid get variable",
  ];
}
echo json_encode($response);

function updateAccountSecret($accountSecretMessage)
{
  $success = false;
  $users = json_decode(file_get_contents("../../data/users.json"));
  foreach ($users as $user) {
    if ($user->email == $_SESSION["passwordless"]["loggedInEmail"]) {
      $user->accountSecretMessage = htmlspecialchars($accountSecretMessage);
      $success = true;
    }
    $newUsers[] = $user;
  }
  file_put_contents("../../data/users.json", json_encode($newUsers));

  return [
    "success" => $success,
    "message" => "Account secret updated",
    "accountSecretMessage" => $accountSecretMessage,
  ];
}

// function
// $respons = ["success" => true, "message" => "Account logged out"];
