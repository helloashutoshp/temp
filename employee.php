<?php

session_start();

if (!isset($_SESSION["user1"])) {
  header("Location:login.php");
}



?>


<?php include('includes/header.php')   ?>
<?php include('includes/navbar.php')   ?>
<?php include('includes/sidebar.php')   ?>





<div class="content-wrapper">
  <?php

<h1>dlkfhfh</h1>
  if (isset($_SESSION['status'])) {
  ?>

    <script>
      window.addEventListener("load", function() {
        Swal.fire({
          icon: 'success',
          title: 'Deleted....',
          text: 'Your record is deleted',

        });
      });
    </script>

  <?php

    unset($_SESSION['status']);
  }


  if (isset($_SESSION['status-code'])) {
  ?>
    <script>
      window.addEventListener("load", function() {
        Swal.fire({
          icon: 'success',
          title: 'Updated....',
          text: 'Your record is updated',

        });
      });
    </script>
  <?php
    unset($_SESSION['status-code']);
  }



  ?>

  <div class="container">



    <table class="table ta" id="myTable">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">NAME</th>
          <th scope="col">EMAIL</th>
          <th scope="col">GENDER</th>
          <th scope="col">AGE</th>
          <th scope="col">CITY</th>
          <th scope="col">IMAGE</th>
          <th scope="col">ACTION</th>


        </tr>
      </thead>
      <tbody>
        <?php

        $server = "localhost";
        $user = "root";
        $pass = "123456";
        $db = "inner";

        $conn = mysqli_connect($server, $user, $pass, $db);


        $sql = "select person.id,person.name,person.email,person.age,person.gender,cityy.city from person join cityy on person.city=cityy.cid ";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_num_rows($result);


        $n = 1;
        if (!$row == null) {
          while ($num = mysqli_fetch_assoc($result)) {
            $id = $num['id'];


        ?>



            <tr>
              <th scope="row"><?php echo $n ?></th>
              <td><?php echo $num['name'] ?></td>
              <td><?php echo $num['email'] ?></td>
              <td><?php echo $num['gender'] ?></td>


              <td><?php echo $num['age'] ?></td>
              <td><?php echo $num['city'] ?></td>


              <td>
                <?php $sql2 = "SELECT * FROM image WHERE  im_id = $id";
                $result2 = mysqli_query($conn, $sql2);



                while ($row2 = mysqli_fetch_assoc($result2)) {
                
                
            
                  
                ?>
                <img src="media/<?php echo $row2['media'] ?>" width="50px" alt="">

                <?php

                }
                ?>
              </td>


              <td>


                <a href="up.php?id=<?php echo $num['id'] ?>&gender=<?php echo $num['gender'] ?>&city=<?php echo $num['city'] ?>" class="btn btn-warning">Edit</a>



                <input type="hidden" class="delete_id_value" value="<?php echo $num['id']; ?>">
                <a href="delete.php?id=<?php echo $num['id'] ?>" type="submit" class="delete_btn_ajax btn btn-danger" id="del">Delete</a>
                </form>
              </td>
            </tr>

        <?php
            $n = $n + 1;
          }
        }
        ?>
      </tbody>
    </table>




  </div>
</div>




<a href="index.php" class="btn btn-dark set">Return</a>




<?php include('includes/footer.php')   ?>