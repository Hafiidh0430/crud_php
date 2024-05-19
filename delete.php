<?php
require 'db_connect.php';

$id = $_GET['user'];

$update_data = $db->prepare('DELETE FROM login_crud WHERE id = ?');
$update_data->execute([ $id ]);

header('location: table.php');
?>
