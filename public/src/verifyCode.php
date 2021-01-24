<?php
header("Content-Type: application/json");

$response = ["valid" => false];

session_start();
if ($_POST["verificationCode"] == $_SESSION["verificationCode"]) {
  $response = [
    "valid" => true,
    "accountEmail" => $_SESSION["email"],
    "newAccount" => true,
  ];
  $users = json_decode(file_get_contents("../../data/users.json"));
  foreach ($users as $user) {
    // $response["users"][] = $user->email;
    if ($user->email == $_SESSION["email"]) {
      $response["newAccount"] = false;
    }
  }
  if ($response["newAccount"]) {
    $users[] = ["email" => $_SESSION["email"]];
    file_put_contents("../../data/users.json", json_encode($users));
  }
}

echo json_encode($response);
