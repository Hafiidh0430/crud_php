<?php
require 'db_connect.php';
$datas = $db->query('SELECT * FROM login_crud')->fetchAll(PDO::FETCH_OBJ);

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = '1a3LM3W966D6QTJ5BJb9opunkUcw_d09NCOIJb9QZTsrneqOICoMoeYUDcd_NfaQyR787PAH98Vhue5g938jdkiyIZyJICytKlbjNBtebaHljIR6-zf3A2h3uy6pCtUFl1UhXWnV6madujY4_3SyUViRwBUOP-UudUL4wnJnKYUGDKsiZePPzBGrF4_gxJMRwF9lIWyUCHSh-PRGfvT7s1mu4-5ByYlFvGDQraP4ZiG5bC1TAKO_CnPyd1hrpdzBzNW4SfjqGKmz7IvLAHmRD-2AMQHpTU-hN2vwoA-iQxwQhfnqjM0nnwtZ0urE6HjKl6GWQW-KLnhtfw5n_84IRQ';

if(isset($_COOKIE['token'])){
	$decoded = JWT::decode($_COOKIE['token'], new Key($key, 'HS256'));
} else {
	header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet" />
</head>

<body>
    <div class="container-table w-[50%] ml-[25%] mt-10 align-center flex justify-center items-center">
        <div class="grid w-full wrapper">
            <button class="p-2 rounded-[8px] w-[10rem] mb-8 text-white bg-blue-500" type="button"><a href="insert.php">Add data +</a></button>
            <table class="table border-2 border-black">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($datas as $data) : ?>
                        <tr>
                            <td><?= $data->id ?></td>
                            <td><?= $data->email ?></td>
                            <td><?= $data->no_telp ?></td>
                            <td>
                                <a href="edit.php?user=<?= $data->id ?>">Edit</a>
                                <a href="delete.php?user=<?= $data->id ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>