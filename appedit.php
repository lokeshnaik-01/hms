<?php include 'session.php' ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Edit Appointment</title>
    <?php include 'style.php' ?>
    <style>
      .tab{
        padding-left:150px;
        padding-right:100px;
      }
      .tab{
        overflow:auto;
      }
    </style>
  </head>
  <body>
    <?php include 'header.php' ?>
    <div class="row2">
      <?php include 'sidebar.php' ?>
      <div class="column1 right1">

          <div class="tab">
              <form style="padding-left:100px;padding-top:10px;padding-right:100px;"action="<?php $_SERVER['PHP_SELF']; ?>" style="padding-top:20px;" method="post">
               <input required class="form-control" type="text" name="mname1" placeholder="Enter Appointment ID">
               <input style="background-color:black;color:white;margin-top:3px;" class="btn btn-primary" type="submit" name="pdet" value="Show Appointment Details">
              </form>
           <br>
           <?php
             if(isset($_POST['pdet']))
             {
               $aid=$_POST['mname1'];
               $conn=mysqli_connect("localhost","root","","hospital")or die("connection failed");
               $sql=" SELECT * FROM appointment where aid='$aid'";
               $result=mysqli_query($conn,$sql) or die("Query Unsuccessfull.");
               if(mysqli_num_rows($result) > 0)
               {
                   while($row=mysqli_fetch_assoc($result))
                   {
                  ?>
                  <form action="updateapp.php" method="post">
                  <div style="padding-left:250px;padding-right:320px;font-size:larger;">
                  <div class="container">
                          <div class="row">
                          <div class="col-xs-2">
                          <h1 style="padding-top:25px;"><center>Update Appointment</center></h1>
                          <p>Change the necessary details to be Updated</p>
                          <hr class="mb-3">
                              <label for="pid"><b>Patient ID</b></label>
                                    <input type="hidden" name="aid" value="<?php echo $row['aid']; ?>">
                                    <input required class="form-control" type="text" name="pid" readonly value="<?php echo $row['pid']; ?>">
                              <label for="adate"><b>Date of Appointment</b></label>
                                    <input required class="form-control" type="date" name="adate" value="<?php echo $row['adate']; ?>">

                              <label for="did"><b>Doctor</b></label>
                              <div>
                                  <?php
                                  $sql1="SELECT * FROM doctor";
                                  $result1=mysqli_query($conn,$sql1) or die("Query Unsuccessfull.");
                                  if(mysqli_num_rows($result1) > 0)
                                  {
                                      echo ' <select name="dname" class="form-control">';
                                          while($row1=mysqli_fetch_assoc($result1)){
                                            if($row['did']==$row1['did'])
                                            {
                                              $select="selected";
                                            }
                                            else {
                                              $select="";
                                            }
                                            echo "<option {$select} value='{$row1['did']}'>{$row1['dname']}</option>";
                                    }
                                  echo "</select>";
                                }
                                  ?>
                              </div>
                          <hr class="mb-3">
                          <input class="btn btn-primary" id="register" type="submit" name="padd" value="Edit Medicine Information" onclick="return mess();">
                          </div>
                          </div>
                      </div>
                  </div>
                  </form>
               <?php }
             }
             else
             {
               ?> <h1><center>No Appointment present with given ID</center></h1> <?php
             }
          }
               ?>

      </div>
    </div>
  </div>
  </body>
</html>
