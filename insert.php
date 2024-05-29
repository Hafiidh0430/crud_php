<?php
require 'db_connect.php';

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

if(isset($_COOKIE['token'])){
	$decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
} else {
	header('location: login.php');
}

if (!empty($_POST)) {
    $email = $_POST["email"];
    $no_telp = $_POST["no_telp"];

    $insert_data = $db->prepare('INSERT INTO login_crud (email, no_telp) VALUES (?, ?) ');
    $insert_data->execute([$email, $no_telp]);

    header('location: table.php');
} else if (empty($_POST)){
    $message = "Email or No-Telp isn't empty";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet" />
</head>

<body>
    <div class="container-insert flex justify-center items-center h-screen">
        <div class="wrapper w-[35%]">
            <h1 class="font-semibold text-3xl mb-5">Halo! Selamat Datang</h1>
            <form action="" class="flex flex-col gap-4" method="POST">
                <div class="form-input flex flex-col gap-3">
                    <div class="relative flex flex-col email-form">
                        <label class="" for="email">Email</label>
                        <input value="" class="p-3 rounded-[8px] border-[3px] border-blue-500 outline-[1px] outline-blue-500" type="text" name="email" id="email">
                    </div>

                    <div class=" flex flex-col email-no_telp">
                        <label for="no_telp">No Telp</label>
                        <input value="" class="p-3 rounded-[8px] border-[3px] border-blue-500 outline-[1px] outline-blue-500" type="no_telp" name="no_telp" id="no_telp">
                    </div>
                </div>
                <button class="p-3 rounded-[8px] text-white bg-blue-500" type="submit">Add data</button>
                <p> <? $message ?></p>
            </form>
        </div>
    </div>
</body>

</html>