<?php
require 'db_connect.php';

$id = $_GET['user'];

$update_data = $db->prepare('SELECT * FROM login_crud WHERE id = ?');
$update_data->execute([$id]);
$select_user = $update_data->fetchObject();

if (!empty($_POST)) {
    $update_email = $_POST['email'];
    $update_no_telp= $_POST['no_telp'];

    $update_user = $db->prepare('UPDATE login_crud SET email = ?, no_telp= ? WHERE id = ?');
    $update_user->execute([$update_email, $update_no_telp, $id]);

    header('location: table.php');
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
            <h1 class="font-semibold text-3xl mb-5">Update data <?= $select_user->email ?></h3>
            <form action="" class="flex flex-col gap-4" method="POST">
                <div class="form-input flex flex-col gap-3">
                    <div class="relative flex flex-col email-form">
                        <label class="" for="email">Email</label>
                        <input value="<?= $select_user->email ?>" class="p-3 rounded-[8px] border-[3px] border-blue-500 outline-[1px] outline-blue-500" type="text" name="email" id="email">
                    </div>

                    <div class=" flex flex-col email-password">
                        <label for="password">No Telp</label>
                        <input value="<?= $select_user->no_telp?>" class="p-3 rounded-[8px] border-[3px] border-blue-500 outline-[1px] outline-blue-500" type="text" name="no_telp" id="no_telp">
                    </div>
                </div>
                <button class="p-3 rounded-[8px] text-white bg-blue-500" type="submit">Update data</button>
            </form>
        </div>
    </div>
</body>

</html>