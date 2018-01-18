<?php 
$con = new PDO('mysql:host=localhost;dbname=school', 'root', '');
$statement = $con->prepare('select * from teachers order by id desc');
$statement->execute();
$teachers = $statement->fetchAll(PDO::FETCH_OBJ);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
  <div class="container">
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="create.php">Create</a></li>
    </ul>
  </div>
 <div class="container">
   <div class="card mt-5">
     <div class="card-header">
       <h2>All teachers</h2>
     </div>
     <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
        <?php foreach($teachers as $teacher): ?>
        <tr>
          <td><?= $teacher->id; ?></td>
          <td><?= $teacher->name; ?></td>
          <td><?= $teacher->email; ?></td>
          <td>
            <a class="btn btn-info" href="edit.php?id=<?= $teacher->id; ?>">Edit</a>
            <a class="btn btn-warning" href="delete.php?id=<?= $teacher->id; ?>">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>


      </table>
     </div>
   </div>
 </div> 
</body>
</html>