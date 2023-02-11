<?php

session_start();
    //connecting to database
    include 'partials/_dbconnect.php';
   
if(isset($_POST["email"]) && isset($_POST["pwd"])){
    $student_id=$_POST['email'];
    $spassword = $_POST['pwd'];
    //SELECTING Email and Password of student from database
    $sql="SELECT * FROM student where student_id='$student_id' AND password='$spassword'";
    $run_query = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
 
if($count == 1){
     if(($row["student_id"]==$student_id) && ($row["password"]==$spassword)){   //Condition for checking Email and Password
        $_SESSION["student_id"] = $row["student_id"];
        $_SESSION["student_id_login"]=1;
        echo "Login Successful";
         header('Location: student-profile.php'); // move to profile page in case of correct ID and Password
        } 
  }
else{
    $tutor_id=$_POST['email'];
    $tpassword = $_POST['pwd'];
    //SELECTING Email and Password of tutor from database
    $sql="SELECT * FROM tutor where tutor_id='$tutor_id' AND password='$tpassword'";
    $run_query = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
 
    if($count == 1){
    if(($row["tutor_id"]==$tutor_id) && ($row["password"]==$tpassword)){   //Condition for checking Email and Password
        $_SESSION["tutor_id"] = $row["tutor_id"]; 
        $_SESSION["tutor_id_login"]=1;
        echo "Login Successful";
         header('Location: tutor-profile.php'); // move to profile page in case of correct ID and Password
        } 
 
    }
    else{
        echo '<script language="javascript">';
        echo 'alert("INCORRECT EMAIL OR PASSWORD");';
        echo 'window.location = "loginform.php"';   // remain on the same page in case of wrong ID or Password
        echo '</script>';
    }
}
     
 }

 
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

    <title>Online tuition</title>
</head>

<body>
    <?php require '<partials/_header.php'?>

 <!-- Start of main content -->

  <!-- Form for login -->
    <div class="container student-register-main">
    <div class="text-center">
        <h2 style="text-align: center; color: rgb(9, 13, 66);  padding-bottom: 20px;"><b> USER LOGIN</b></h2>
        </div>
       
        <h3 style='margin-bottom: 20px; color: rgb(9, 13, 66);'>Kindly enter your login credentials</h3>
    
        <form class="form-horizontal"  method="POST" > 

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd" style='margin-top: 10px;'>Password:</label>
                <div class="col-sm-10" style='margin-top: 10px;'>
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password" required>
                </div>
            </div>
            <div>

            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" style='margin-top: 50px;'>
                    <button type="submit" name="submit"  class="btn">Login</button>
 
 
                </div>
            </div>
        </form>
    </div>

    <!-- End of main content-->
 
    <?php require '<partials/_footer.php'?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
</body>

</html>