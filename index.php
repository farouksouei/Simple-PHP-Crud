<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  
  <title>PHP CRUD</title>
</head>
<body>
  
  <?php require_once 'process.php'; ?>
  
  <?php
    if (isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>
  
  <?php 
    $mysqli = new mysqli("localhost", "root", "", "crud") or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
  ?>
  
  <div class="container">
    <h2>PHP CRUD</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Location</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td>
              <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
              <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
      <tfoot>
      <form action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <th>Complete the form please</th>
    <th>
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" placeholder="Enter your name" class="form-control" value="<?php echo $name; ?>">
    </div>
    </th>  
    <th>
    <div class="form-group">
      <label>Location</label>
      <input type="text" name="location" placeholder="Enter your location" class="form-control" value="<?php echo $location; ?>">
    </div>
    </th>
    <th>
    <div class="form-group">
    <label>Click here to Submit!!</label>
      <?php if ($update == true): ?>
        <button type="submit" class="form-control btn btn-info" name="update">Update</button>
      <?php else: ?>
        <button type="submit" name="save" class="form-control btn btn-primary">Submit</button>
      <?php endif; ?>
    </div> 
      </th> 
  </form>
      </tfoot>  
    </table>
   </div>
</body>
</html>