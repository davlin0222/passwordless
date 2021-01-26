<?php
session_start();

header("Content-Type: application/json");
echo json_encode(sendEmail($_POST["email"]));

function sendEmail($email)
{
  $verificationEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
  if (!$verificationEmail) {
    return [
      "success" => false,
      "message" => "Not a valid email address",
    ];
  }
  $_SESSION["verificationEmail"] = $verificationEmail;

  $verificationCode = substr(md5(uniqid(rand(), true)), 0, 6);
  $_SESSION["verificationCode"] = $verificationCode;
  $_SESSION["verificationRequestTime"] = time();

  $email = [
    "emailAddress" => $verificationEmail,
    "subject" =>
      "🔑 Verify your email for Passwordless DEMO - creatorise.com",
    "message" =>
      "Hello Dear user, 🦌\nThank you for verifying your email address at the Passwordless DEMO by David Lindström \n\nPlease enter this verification code in the Passwordless DEMO\n\n\nVerification Code: " .
      $verificationCode,
  ];

  mail($email["emailAddress"], $email["subject"], $email["message"]);

  $isNewUser = true;
  $users = json_decode(file_get_contents("../../data/users.json"));
  foreach ($users as $user) {
    if ($user->email == $verificationEmail) {
      $isNewUser = false;
    }
  }
  if ($isNewUser) {
    $users[] = ["email" => $verificationEmail, "verifiedEmail" => false];
    file_put_contents("../../data/users.json", json_encode($users));
  }

  return [
    "success" => true,
    "message" => "Email sent to " . $email["emailAddress"],
    // "debugRespons" => [
    //   "email" => $email,
    //   "code" => $verificationCode,
    //   "isNewUser" => $isNewUser,
    // ],
  ];
}

/**
 * validate email
 * create code
 * set time
 * send email
 * add email to db
 */

// $debugRespons = [
//   "code" => $verificationCode,
//   "email" => $verificationEmail,
//   "subject" => "Subject of email",
//   "message" =>
//     "Enter this verification code in browser \n Code: " . $verificationCode,
//   "success" => $verificationEmail ? true : false,
// ];

// echo json_encode($debugRespons);
