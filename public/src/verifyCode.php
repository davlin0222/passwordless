<?php
session_start();

header("Content-Type: application/json");
echo json_encode(verifyCode($_POST["verificationCode"]));

function verifyCode($verificationCode)
{
  $ValidTimeDifferenceMax = 2 * 60;
  $timeDifference = time() - $_SESSION["verificationRequestTime"];

  if ($timeDifference > $ValidTimeDifferenceMax) {
    return [
      "success" => false,
      "message" => "Waited to long ($timeDifference s), maximum is $ValidTimeDifferenceMax s",
    ];
  }
  if ($verificationCode == $_SESSION["verificationCode"]) {
    $users = json_decode(file_get_contents("../../data/users.json"));
    foreach ($users as $user) {
      if ($user->email == $_SESSION["verificationEmail"]) {
        $user->verifiedEmail = true;
      }
      $newUsers[] = $user;
    }
    file_put_contents("../../data/users.json", json_encode($newUsers));

    return [
      "success" => true,
      "message" => "Verification code is correct",
    ];
  }
  // if (strlen($verificationCode) < strlen($_SESSION["verificationCode"])) {
  //   return [
  //     "success" => false,
  //     "message" => "Verification code too short",
  //   ];
  // }
  // if (strlen($verificationCode) > strlen($_SESSION["verificationCode"])) {
  //   return [
  //     "success" => false,
  //     "message" => "Verification code too long",
  //   ];
  // }
  return [
    "success" => false,
    "message" => "Incorrect verification code",
  ];
}

// $response = ["time" => checkTime()];

/*
  isValidTimeWindow
  Time window
  first time
  second time
*/

// $isValidTimeWindow = function ($time1) {
//   return function ($timeDifference) use ($time1) {
//     return function ($time2) use ($timeDifference, $time1) {
//       return $time2 > $time1 && $time2 < $time1 + $timeDifference;
//     };
//   };
// };

// // $timeWindow = $isValidTimeWindow(2 * 60);
// // $firstTime = $timeWindow($_SESSION["verificationRequestTime"]);
// // $secondTime = $firstTime(time());
// $secondTime = respons(
//   $isValidTimeWindow($_SESSION["verificationRequestTime"])(2 * 60)(time())
// );
// $response = $secondTime;

// echo json_encode($response);

// function respons($isValidTimeWindow)
// {
//   return $response;
// }

/** respond back with
 * success = true | false
 * errorMsg
 *
 */

// $isValidTimeWindow = function ($timeStamp) use ($_SESSION) {
//   $TIME_WINDOW = 2 * 60 * 1000;
//   return $_SESSION["verificationRequestTime"] < $timeStamp + $TIME_WINDOW;
// };
// $isVerificationCodeValid = function ($verificationCode) use ($_SESSION) {
//   return $verificationCode == $_SESSION["verificationCode"];
// };

// $compareTime = isvalidTimeWindow(2 * 60 * 1000)
// $isValidTimeWindow = isValidTimeWindow($_SESSION["verificationRequestTime"] time())

// $response = respons($isValidTimeWindow);

// function respons($isValidTimeWindow1)
// {
//   return ["valid" => $isValidTimeWindow1];
// }

// /**
//  * Check time
//  * Check password
//  *
//  * Return a respons
//  */

// $response = [
//   "valid" => false,
//   "isValidTimeWindow" => $isValidTimeWindow(time()),
// ];

// if ($_POST["verificationCode"] == $_SESSION["verificationCode"]) {
//   $response = [
//     "valid" => true,
//     "accountEmail" => $_SESSION["email"],
//     "newAccount" => true,
//   ];
//   $users = json_decode(file_get_contents("../../data/users.json"));
//   foreach ($users as $user) {
//     // $response["users"][] = $user->email;
//     if ($user->email == $_SESSION["email"]) {
//       $response["newAccount"] = false;
//     }
//   }
//   if ($response["newAccount"]) {
//     $users[] = ["email" => $_SESSION["email"]];
//     file_put_contents("../../data/users.json", json_encode($users));
//   }
// }
