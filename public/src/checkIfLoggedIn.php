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
    if ($user->email == $_SESSION["passwordless"]["loggedInEmail"]) {
      return [
        "isLoggedIn" => true,
        "loggedInEmail" => $_SESSION["passwordless"]["loggedInEmail"],
        "accountSecretMessage" => $user->accountSecretMessage,
      ];
    }
  }
  return [
    "isLoggedIn" => false,
  ];
}
