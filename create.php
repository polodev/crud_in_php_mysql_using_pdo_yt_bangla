<?php 
if (isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $con = new PDO('mysql:host=localhost;dbname=school', 'root', '');
  $statement = $con->prepare("insert into teachers(name, email) values(:name, :email)");
  $statement->execute([
    ':name' => $name,
    ':email' => $email
  ]);
}

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
       <h2>Add a teacher</h2>
     </div>
     <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-outline-info">Add a teacher</button>
        </div>
      </form>
     </div>
   </div>
 </div> 
</body>
</html>