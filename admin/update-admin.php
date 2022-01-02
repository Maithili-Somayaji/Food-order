<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            //1.Get the id of selected admin

            $id=$_GET['id'];

            //2.Create SOL Query to get details

            $sql="SELECT * FROM tbr_user WHERE cust_id=$id";

            //Execute the query
             $res=mysqli_query($conn,$sql);

             //Check whether the query is excuted or not

             if($res==TRUE)
             {
                 //Check whether the query is excuted or not
                 $count=mysqli_num_rows($res);
                 //Check whether we have admin data or not
                 if($count==1){
                     //Get details
                     //echo "Admin Available";
                     $row=mysqli_fetch_assoc($res);

                     $full_name=$row["fname"];
                     $username=$row["username"];

                 }
                 else{
                     //Redirect to manage-admin page
                     header("location:".SITEURL.'admin/manage-admin.php');
                 }
             }
        ?>
        <form action="" method="POST">
        <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td><input type="text" name="username" value="<?php echo $username?>"></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
  //Check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
      //echo "Button clicked";
      //Get all the values from form for update
      echo $id=$_POST['id'];
      echo $full_name=$_POST['full_name'];
      echo $username=$_POST['username'];

      //Create SQL Query to update Admin
      $sql="UPDATE tbr_user SET
      fname='$full_name',
      username='$username'
      WHERE cust_id='$id'
      ";

      //Execute the query
      $res=mysqli_query($conn,$sql);

      //Check whether the query is excuted or not
      if($res==TRUE)
      {
          //Query executed and Updated
          $_SESSION['update']="<div class='success'>Admin Updated Successfully</div>";
          //Redirect Page to manage admin
         header('location:'.SITEURL.'admin/manage-admin.php');
      }
      else{
          //Not Updated
          $_SESSION['update']="<div class='error'>Failed to Update Successfully</div>";
          //Redirect Page to manage admin
          header('location:'.SITEURL.'admin/manage-admin.php');
      }
  }
?>

<?php include('partials/footer.php')?>