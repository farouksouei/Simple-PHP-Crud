<?php

session_start();
$mysqli = new mysqli("localhost", "root", "", "crud") or die(mysqli_error($mysqli));

$id=0;
$name="";
$location="";
$update=false;

//ADD RECORD
if(isset($_POST['save'])){
  $name = $_POST['name'];
  $location = $_POST['location'];
  
  $_SESSION['message'] = "Record has been added!";
  $_SESSION['msg_type'] = "success";
  $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or die($mysqli->error);

  header("location: index.php");
}

//DELETE RECORD
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location: index.php");
}

//EDIT RECORD
if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update = true;
  $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
  if ($result->num_rows){
    $row = $result->fetch_array();
    $name = $row['name'];
    $location = $row['location'];
  }
  //header("location: index.php");
}

if(isset($_POST['update'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $location = $_POST['location'];

  $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);
  $_SESSION['message'] = "Record has been updated!";
  $_SESSION['msg_type'] = "warning";

  header("location: index.php");
}
