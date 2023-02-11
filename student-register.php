<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    //connecting to database
    include 'partials/_dbconnect.php';
    //assigning variables to data entered by the user
    $student_id=$_POST['email'];
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $spassword = $_POST['pwd'];
    $scontact = $_POST['studentcontact'];
    $emcontact=$_POST['studentemgcontact'];

    //INSERTING data into 'student' table and 'student_contacts' table accordingly
    $sql ="INSERT INTO `onlinetuitionmanagementsystem`.`student` (`student_id`,`fname`, `lname`, `password`) VALUES ('$student_id', '$fname', '$lname', '$spassword');";
    $sql .="INSERT INTO `onlinetuitionmanagementsystem`.`student_contacts` (`student_id`, `contacts`) VALUES ('$student_id', '$scontact');";
    
    //emergency contact is optional
    if ($emcontact!='' ){
        echo isset($_POST['studentemgcontact']);
        $sql .="INSERT INTO `onlinetuitionmanagementsystem`.`student_contacts` (`student_id`, `contacts`) VALUES ('$student_id', '$emcontact');";
         }
    $sql .="INSERT INTO `student_finance` (`date`, `student_id`, `status`) VALUES (TIMESTAMPADD(MONTH, 1, SYSDATE()), '$student_id', 'unpaid');";
    
    //if the data has successfully been inserted in the database move to 'student-subject.php'
    if ($conn->multi_query($sql)==true){
        echo "SUCCESSFULLY INSERTED";
        $_SESSION["student_id"]=$student_id;
        header('Location: student-subject.php');
    }
    else{
        echo "ERROR $sql <br> $conn->error ";
    }
    //closing database connection
    $conn->close();

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

   <!-- Form for Student Registration -->
  <div class="container student-register-main">
        <h2 style="margin-bottom:30px; color: rgb(9, 13, 66);"><b>TO REGISTER AS A STUDENT PLEASE FILL OUT THE FORM BELOW</b></h2>

         <form class="form-horizontal"  method="POST" name ="StudentForm"  >
            <div class="form-group">
                <label class="control-label col-sm-2" for="fname">First name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter first name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lname">Last name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  name="lname" id="lname" placeholder="Enter last name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="studentcontact">Contact no.</label>
                <div class="col-sm-10">
                    <input type="tel"  pattern="[0-9]{4}-[0-9]{7}" class="form-control" name="studentcontact" id="studentcontact" placeholder="Enter your contact number" required>
                    <small>Format: 03XX-XXXXXXX</small>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="tutoremgcontact">Emergency Contact no. (OPTIONAL)</label>
                <div class="col-sm-10">
                    <input  type="tel"  pattern="[0-9]{4}-[0-9]{7}"  class="form-control" name="studentemgcontact" id="studentemgcontact" value='' placeholder="Enter your contact number">
                    <small>Format: 0300-4567890</small>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control"  name="email" id="email" placeholder="Enter email" required>
                   
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password" required>
                </div>
            </div>        

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10" style="margin-top: 10px;">                    
                        <button type="submit"name = "register" class="btn" id='edit'>Register</button>
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