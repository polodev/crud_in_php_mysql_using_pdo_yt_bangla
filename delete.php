<?php 
$id = $_GET['id'];
$con = new PDO('mysql:dbname=school;host=localhost', 'root', '');
$statement = $con->prepare('delete from teachers where id=:id');
$statement->execute([
  ':id' => $id
]);

header('location: /');

