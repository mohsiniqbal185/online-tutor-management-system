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

    <?php 
    //connecting to database
    include 'partials/_dbconnect.php';
    session_start();
    require '<partials/_header.php'; ?>
 
    <div class="container student-subject-main">
        <h2 style="text-align: center; color: rgb(9, 13, 66);  padding-bottom: 20px;"><b>SELECT TEACHERS FOR CHOOSEN SUBJECTS </b></h2>
        <form class="form-horizontal" action="choose-teacher.php" method="GET">
            <div class="form-group">
                <div class="row">   

                 <?php 
                $student_id=$_SESSION["student_id"];
                $course_ids = array();
                $course_filter="";
                if(isset($_GET['course_ids']) && $_GET['course_ids'] !=''){
                    $course_ids = explode(',', $_GET['course_ids']);
                    $cx="'".implode("','", $course_ids). "'";
                    $course_filter = "and E.course_id in ($cx)";

                }
                $sql="SELECT E.course_id, M.course_name from student_courses AS E join courses AS M ON E.course_id=M.course_id where student_id='$student_id'$course_filter;";
                $run_query = mysqli_query($conn,$sql);
	            $count = mysqli_num_rows($run_query);
                while ($row_element = mysqli_fetch_array($run_query)){
                       $row[]=$row_element;
                }
                $_SESSION["course"] = $row;
                $x=1 ;                                
                for ($x; $x <= $count; $x++){
                echo '<div class="col-md-3">
                        <h4 style="color: rgb(9, 13, 66);"><u>'.$row[$x-1]["course_name"].'</u></h4>';
                $var=$row[$x-1]["course_id"];
                $sql1="SELECT E.tutor_id, M.fname,M.lname from tutor_courses AS E join tutor AS M ON E.tutor_id=M.tutor_id where course_id='$var';";
                $run_query1 = mysqli_query($conn,$sql1);
                $count1 = mysqli_num_rows($run_query1);
                $row1=[]; 
                while ($row_element1 = mysqli_fetch_array($run_query1)){
                       $row1[]=$row_element1;}
                $_SESSION["course'.$x.'"] = $row1;
                $x1=1;   
                for ($x1; $x1 <= $count1; $x1++){
                    echo '<div>
                            <label  style="color: rgb(9, 13, 66);"><input color: rgb(9, 13, 66) class="Subjects'.$x.'" style="color: rgb(9, 13, 66);" type="checkbox" name="tutor'.$x.$x1.'" value="'.$row1[$x1-1]["tutor_id"].'" ><b>   '.$row1[$x1-1]["fname"]." ".$row1[$x1-1]["lname"].'</b></label>
                    </div>';
                              }
                echo'</div> ';  }
            echo'</div></div>

            <div class="form-group">
                <div class="text-center">';
                if(isset($_SESSION["student_id_login"])){
                   echo' <button type="submit" name="proceed_login" id="proceed_login" class="btn" ><b>Go To Profile</b></button>';
                }
                else{
                   echo' <button type="submit" name="proceed_login" id="proceed_login" class="btn-success btn-lg" > Proceed to Login</button>';}
                echo' </div>
            </div> 
             '; ?>
             
        </form>
    </div>


 <!-- End of main content-->

<?php require '<partials/_footer.php'?>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                          
        <script>
 
            $(function() {
                // jQuery methods go here...
                $('input.Subjects1[type=checkbox]').change(function(e) {
                    if ($('input.Subjects1[type=checkbox]:checked').length !=1) {
                        $(this).prop('checked', false)
                        alert("You can select only 1 Tutor for 1 Subject !");
                    }
                })

                $('input.Subjects2[type=checkbox]').change(function(e) {
                if ($('input.Subjects2[type=checkbox]:checked').length !=1) {
                     $(this).prop('checked', false)
                     alert("You can select only 1 Tutor for 1 Subject !");
                 }
                })

                $('input.Subjects3[type=checkbox]').change(function(e) {
                    if ($('input.Subjects3[type=checkbox]:checked').length!=1) {
                      $(this).prop('checked', false)
                      alert("You can select only 1 Tutor for 1 Subject !");
                    }
                })

                $('input.Subjects4[type=checkbox]').change(function(e) {
                if ($('input.Subjects4[type=checkbox]:checked').length!=1) {
                     $(this).prop('checked', false)
                     alert("You can select only 1 Tutor for 1 Subject !");
                 }
                })

                $('input.Subjects5[type=checkbox]').change(function(e) {
                if ($('input.Subjects4[type=checkbox]:checked').length!=1) {
                     $(this).prop('checked', false)
                     alert("You can select only 1 Tutor for 1 Subject !");
                 }
                })

                $('input.Subjects6[type=checkbox]').change(function(e) {
                if ($('input.Subjects4[type=checkbox]:checked').length!=1) {
                     $(this).prop('checked', false)
                     alert("You can select only 1 Tutor for 1 Subject !");
                 }
                })
            });
 
        </script>
               


</body>

</html>