<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" ){
    session_start();
        //connecting to database
        include 'partials/_dbconnect.php';
        if (isset($_GET['proceed_login'])){            
            $student_id=$_SESSION["student_id"];
            $course_rec=$_SESSION["course"] ;
            $count=count($course_rec);
            $x=1;
            for ($x; $x <= $count; $x++) {
                $tutor_rec=$_SESSION["course'.$x.'"] ;
                $count1=count($tutor_rec);        
                $x1=1 ;
            for ($x1; $x1 <= $count1; $x1++) {
                
              $tutor= "tutor$x$x1";
            if (isset($_GET[$tutor])){
                $tutor_id=$_GET[$tutor];
                //INSERTING student's selected tutors into the 'student_tutor' table
                $sqltutor="INSERT INTO `onlinetuitionmanagementsystem`.`student_tutor` (`student_id`, `tutor_id`) VALUES ('$student_id', '$tutor_id');";           
         
             if ($conn->query( $sqltutor)==true){
                echo "SUCCESSFULLY INSERTED";}
            else{
                echo "ERROR";}
            }}}
       
 $conn->close();
              
}
if(isset($_SESSION["student_id_login"])){
    header('Location: student-profile.php');
}
else{
    header('Location: loginform.php');}
}
?>

