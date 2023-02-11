<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" ){
    session_start();
        //connecting to database
        include 'partials/_dbconnect.php';
        if (isset($_GET['submit'])){
            $tutor_id=$_SESSION["tutor_id"];
            $del_rec=$_SESSION["Del_rec"] ;
            $count=count($del_rec);
            $pay=0;
            for ($x =1; $x <= $count; $x++) {
                $subject="subject".$x;
                //echo $subject;
                if (isset($_GET[$subject])){
                    echo $_GET[$subject];
                    $course_id=$_GET[$subject];
                    $payofsubject="SELECT pay_of_sub FROM courses WHERE course_id='$course_id';";
                    $courses="DELETE FROM `tutor_courses` WHERE `tutor_courses`.`course_id`='$course_id' and `tutor_courses`.`tutor_id`='$tutor_id';";
                    if ($conn->query($courses)==true){   
                        $result = $conn->query($payofsubject);
                        $pay=$pay+$result->fetch_assoc()['pay_of_sub'];
                        echo "SUCCESSFUL";  
                    }
                    else{
                        echo "ERROR";
                    }
                    $select_student="SELECT DISTINCT S.student_id FROM (SELECT student_id FROM student_tutor WHERE tutor_id='$tutor_id') as S join (SELECT P.student_id FROM student_courses as P join (SELECT course_id FROM courses WHERE class_id=(SELECT class_id FROM courses WHERE course_id='$course_id')) as Q WHERE P.course_id=Q.course_id )as F WHERE S.student_id=F.student_id;";
                    $result2 = mysqli_query($conn,$select_student);
                    $count2 = mysqli_num_rows($result2);
                    $row=[];
                    while ($row_element = mysqli_fetch_array($result2)){
                                        $row[]=$row_element;
                    }
                    print_r ($row);
                    for ($x1 =1; $x1 <= $count2; $x1++) {
                        $student_id=$row[$x1-1]['student_id'];
                        $delete_student="DELETE FROM student_tutor WHERE student_id='$student_id' and tutor_id='$tutor_id';";
                        $ins_def="INSERT INTO `onlinetuitionmanagementsystem`.`student_tutor` (`tutor_id`, `student_id`) VALUES ('ramish@gmail.com', '$student_id');";
                        $result_def = mysqli_query($conn,$ins_def);
                        $delete_student_course="DELETE FROM student_courses WHERE student_id='$student_id' and course_id='$course_id';";
                        if ($conn->query($delete_student) and $conn->query($delete_student_course)){
                            echo "SUCCESSFUL";
                        }
                        else{
                            echo "error";
                        }
                    }

                    
                }
            }
            $payoftutor= "SELECT tutor_pay FROM tutor WHERE tutor_id='$tutor_id';";
            $result1 = $conn->query($payoftutor);
            $pay=$result1->fetch_assoc()['tutor_pay']-$pay;
            $tutor_pay="UPDATE `tutor` SET `tutor_pay` = '$pay' WHERE `tutor`.`tutor_id` = '$tutor_id';";
            if ($conn->query($tutor_pay)==true){
                echo "SUCCESSFULLY INSERTED";
              
            }
            else{
                echo "ERROR";
            }
                        
        }
$conn->close(); 
header('Location: tutor-profile.php');
}
?>