<?php

  $db = mysqli_connect("localhost","root","","booklibrary");


  ob_start();
?>






<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Book-Library</title>
  </head>
  <body>
    <center><h1 class="mt-5">Database Of Book Library</h1></center>

    <div class="table container">
      <div class="row">
        <!-- form(create table)  -->
        <div class="col-md-6">
          <form method="POST">
            <div class="mb-3">
            <label class="form-label">Add New Category</label>
            <input type="text" class="form-control"placeholder="Category Name" name="cat_name">
          </div>
          <div class="mb-3">
            <label class="form-label">Category Description</label>
            <textarea class="form-control" rows="3" name="cat_desc"></textarea>
          </div>
            <input type="submit" class="btn btn-primary" name="add_cat" value="Add Category">
          </form>

          <!-- New Update the data -->
          <?php

          if (isset($_GET['update_id'])){
            $update_id = $_GET['update_id'];

            $sql44 = "SELECT * FROM category WHERE c_id = '$update_id'";
            $result2 = mysqli_query($db,$sql44);
            while ($row = mysqli_fetch_assoc($result2)) {
              $c_name = $row['c_name'];
              $c_desc = $row['c_desc'];

              
            }
          ?>

          <form method="POST">
            <div><h1>Update Data Base</h1></div>
            <div class="mb-3">
            <label class="form-label">Edit Category</label>
            <input type="text" class="form-control"placeholder="Category Name" name="cat_name" value="<?php echo $c_name;?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Category Description</label>
            <textarea class="form-control" rows="3" name="cat_desc"><?php echo $c_desc;?></textarea>
          </div>
            <input type="submit" class="btn btn-primary" name="update_cat" value="Edit Category">
          </form>

          <?php

            
          }


          ?>

          <!-- <h1>Upadte The Database</h1>
          <form method="POST">
            <div class="mb-3">
            <label class="form-label">Add New Category</label>
            <input type="text" class="form-control"placeholder="Category Name" name="cat_name">
          </div>
          <div class="mb-3">
            <label class="form-label">Category Description</label>
            <textarea class="form-control" rows="3" name="cat_desc"></textarea>
          </div>
            <input type="submit" class="btn btn-primary" name="add_cat" value="Add Category">
          </form> -->



        </div>
        <!-- Add new data to database -->
        <?php
        if (isset($_POST['add_cat'])){
          $c_name = $_POST['cat_name'];
          $c_desc = $_POST['cat_desc'];

         $sql =  "INSERT INTO category(c_name, c_desc) VALUES ('$c_name', '$c_desc')";
         $result = mysqli_query($db,$sql);

         if($result){
          //echo "Value Insert";
         }
         else{
          echo "Not Instert";
         }

        }

        //update category
        if(isset($_POST['update_cat'])){
          $c_name = $_POST['cat_name'];
          $c_desc = $_POST['cat_desc'];


          $sql55 = "UPDATE category SET c_name= '$c_name', c_desc = '$c_desc' WHERE c_id='$update_id'";
          $result2 = mysqli_query($db,$sql55); 

          if($result2){
          header('Location: index.php');
        }
        else{
          echo "Not Update";

        }

      }

        ?>


        <!-- Edit The Data -->




        <div class="col-md-6">
          <table class="table mt-5">
            <thead class="table-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">C-Name</th>
                <th scope="col">C-Desc</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql22 = "SELECT * FROM category";
              $result = mysqli_query($db,$sql22);
              $counter = 0;

              while ($row = mysqli_fetch_assoc($result)) {
                $c_id = $row['c_id'];
                $c_name = $row['c_name'];
                $c_desc = $row['c_desc'];
                $counter++;

                ?>
                <tr>
                <th scope="row"><?php echo $counter; ?></th>
                <td><?php echo $c_name; ?></td>
                <td><?php echo $c_desc; ?></td>
                <td>
                  <a href="index.php?update_id=<?php echo $c_id;?>" style="text-decoration: none; font-weight: 600;" class="badge bg-success">
                  <span>Edit</span>
                  </a>

                  <a href="index.php?delete_id=<?php echo $c_id;?>" style="text-decoration: none; font-weight: 600;" class="badge bg-danger">
                  <span>Delete</span>
                  </a>
              </td>
              </tr>
                <?php

              }



              ?>
            </tbody>
        </table>
        </div>

      </div>
    </div>
    <!-- Delete Operation -->
    <?php

      if(isset($_GET['delete_id'])){
        $del_id = $_GET['delete_id'];

        $sql33 = "DELETE FROM category WHERE c_id = '$del_id'";

        $result = mysqli_query($db,$sql33);
        if($result){
          header('Location: index.php');
        }
        else{
          echo "Not Delete";

        }
      }
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <?php

        ob_end_flush();
    ?>
  </body>
</html>