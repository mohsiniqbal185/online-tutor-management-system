<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
            //connecting to database
            include 'partials/_dbconnect.php';
            $tutor_id=$_SESSION["tutor_id"];
            $x=1;
            $pay=0;
            $sqlcourses="SELECT * FROM courses ;";
            $run_query = mysqli_query($conn,$sqlcourses);
            $count = mysqli_num_rows($run_query);
            for ($x; $x <= $count; $x++) {
            
                $subject="subject".$x;
                if (isset($_POST[$subject])){
                    $course_id=$_POST[$subject];
                    $courses="INSERT INTO `onlinetuitionmanagementsystem`.`tutor_courses` (`tutor_id`, `course_id`) VALUES ('$tutor_id', '$course_id');";
                    $payofsubject="SELECT pay_of_sub FROM courses WHERE course_id='$course_id';";
                    if ($conn->query($courses)==true and $conn->query($payofsubject)==true ){
                        $result = $conn->query($payofsubject);
                        $pay=$pay+$result->fetch_assoc()['pay_of_sub'];
                        echo "$pay";

                    }
                    else{
                        echo "ERROR";
                    }
                
                }
                          
            }
            $payoftutor= "SELECT tutor_pay FROM tutor WHERE tutor_id='$tutor_id';";
            $result1 = $conn->query($payoftutor);
            $pay=$pay+$result1->fetch_assoc()['tutor_pay'];
            $tutor_pay="UPDATE `tutor` SET `tutor_pay` = '$pay' WHERE `tutor`.`tutor_id` = '$tutor_id';";
            if ($conn->query($tutor_pay)==true){
                echo "SUCCESSFULLY INSERTED";
                if(isset($_SESSION["tutor_id_login"])){
                    header('Location: tutor-profile.php');
                }
                else{
                header('Location: loginform.php');}
            }
            else{
                echo "ERROR";
            }
            
            $conn->close();
        }     
?>
