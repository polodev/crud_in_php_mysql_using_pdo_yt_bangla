# CRUD in php mysql


## table create and database
Started mysql server. Login to mysql and create a database.      
connect with database and create table using php. today we connect php with mysql using pdo(PHP data object)         

~~~php

$dsn = 'mysql:host=localhost;dbname=school';

$con = new PDO($dsn, 'root', '');
$con->query("create table teachers (
  id int(11) auto_increment primary key,
  name varchar(30) not null,
  email varchar(30)
)");
~~~


## Create data
make a html form. In this video I am using same page as form action. In such case, we have to check whether form is submitted or not using `isset` and any other helper functions. Today we've used isset function. Once we extract from data using `$_POST` super global we connect with database and insert form data to database     


Html part 

~~~
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
  
~~~  

php part 

~~~php

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
~~~

## Read 

Connect to database. fetch all data from database. and Iterate data in html table    

php part    

~~~php
$con = new PDO('mysql:host=localhost;dbname=school', 'root', '');
$statement = $con->prepare('select * from teachers order by id desc');
$statement->execute();
$teachers = $statement->fetchAll(PDO::FETCH_OBJ);
~~~


html part

~~~html
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
~~~

## Edit 
Edit part is like create part. we just populate predefined value from existing data. We will access id using `$_GET` super global. once we have id we can easily get from database and giving value to form field     

php part    

~~~php
$id = $_GET['id'];
$con = new PDO('mysql:host=localhost;dbname=school', 'root', '');
$statement = $con->prepare('select * from teachers where id=:id');
$statement->execute([
  ':id' => $id
]);
$teacher = $statement->fetch(PDO::FETCH_OBJ);
~~~


html part    

~~~html
<input value="<?= $teacher->name; ?>" type="text" name="name" id="name" class="form-control">
~~~

## Update 

update is like create row in database. we will extract data from form and update to database using update sql query. Once update is successful we will redirect user to home page    

~~~php
if (isset($_POST['name']) && isset($_POST['email'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $statement = $con->prepare("update teachers set name=:name, email=:email where id=:id");
  $statement->execute([
    ':name' => $name,
    ':email' => $email,
    ':id' => $id,
  ]);
  header('location: /');
}
~~~


## Delete 

We will access id using `$_GET` super global. once we have id we will delete that row and redirect back to read page using header function.    

~~~php

$id = $_GET['id'];
$con = new PDO('mysql:dbname=school;host=localhost', 'root', '');
$statement = $con->prepare('delete from teachers where id=:id');
$statement->execute([
  ':id' => $id
]);

header('location: /');

~~~





