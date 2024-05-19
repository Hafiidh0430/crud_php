<?php
require 'db_connect.php';
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