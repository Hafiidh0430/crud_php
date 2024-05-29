<?php

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'db_connect.php';

$err_message = '';
$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

if (empty(($_COOKIE['token']))) {
    $err_message = "Login first for access!";
} else {
    $decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
    header('location: table.php');
}

if (!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email && $password)) {
        $err_message = 'Email and Password can not be empty!';
    } else {
        $query = $db->prepare("SELECT * FROM login_user WHERE email = ? AND password = ?");
        $query->execute([$email, $password]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            if ($data['password'] ===  $_POST['password']) {
                $token = JWT::encode(
                    [
                        'iat'        =>    time(),
                        'nbf'        =>    time(),
                        'exp'        =>    time() + 3600,
                        'data'    => [
                            'email' => $email,
                            'password' => password_hash($password, PASSWORD_DEFAULT)
                        ]
                    ],
                    $key,
                    'HS256'
                );
                setcookie("token", $token, time() + 3600, "/", "", true, true);
                header('location: table.php');
            } else {
                $err_message = 'Wrong Password';
            }
        } else {
            $err_message = 'Wrong Email Address';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet" />
</head>

<body class="">
    <div class="container flex flex-col mx-auto bg-white rounded-lg pt-12 mt-[]">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-10">
                    <form method="POST" name="login" class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl">
                        <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Sign In</h3>
                        <p class="mb-4 text-grey-700">Enter your email and password</p>

                        <div class="flex items-center mb-3">
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                            <p class="mx-4 text-grey-600">or</p>
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                        </div>
                        <label for="email" class="mb-2 text-sm text-start text-grey-900">Email*</label>
                        <input id="email" name="email" type="email" placeholder="mail@loopple.com" class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400 mb-7 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                        <label for="password" class="mb-2 text-sm text-start text-grey-900">Password*</label>
                        <input id="password" name="password" type="password" placeholder="Enter a password" class="flex items-center w-full px-5 py-4 mb-5 mr-2 text-sm font-medium outline-none focus:bg-grey-400 placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                        <div class="flex flex-row justify-between mb-8">
                            <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                <input type="checkbox" checked value="" class="sr-only peer">
                                <div class="w-5 h-5 bg-white border-2 rounded-sm border-grey-500 peer peer-checked:border-0 peer-checked:bg-purple-blue-500">
                                    <img class="" src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/icons/check.png" alt="tick">
                                </div>
                            </label>
                            <button type="submit" class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-2xl bg-blue-600">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>