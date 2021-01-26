<?php
session_start();
echo json_encode(checkIfLoggedIn());

function checkIfLoggedIn()
{
  if (!$_SESSION["passwordless"]["isLoggedIn"]) {
    return ["isLoggedIn" => false];
  }

  $users = json_decode(file_get_contents("../../data/users.json"));
  foreach ($users as $user) {
    if ($user->id == $_SESSION["passwordless"]["loggedInEmail"]) {
      $accountSecretMessage = $user->accountSecretMessage;
    }
  }
  return [
    "isLoggedIn" => true,
    "email" => $_SESSION["passwordless"]["loggedInEmail"],
    "accountSecretMessage" => $accountSecretMessage,
  ];
}
