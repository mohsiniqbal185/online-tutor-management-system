<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" ){
    session_start();
        include 'partials/_dbconnect.php';
        if (isset($_GET['submit'])){
            //and isset($_POST['proceed'])
            
            $student_id=$_SESSION["student_id"];
            $del_rec=$_SESSION["Del_rec"] ;
            $count=count($del_rec);
            $pay=0;
            
            for ($x =1; $x <= $count; $x++) {
            
                $subject="subject".$x;
                echo $subject;
                if (isset($_GET[$subject])){
                     echo $_GET[$subject];
                     $course_id=$_GET[$subject];
                     $payofsubject="SELECT pay_of_sub FROM courses WHERE course_id='$course_id';";
                     $courses="DELETE FROM `student_courses` WHERE `student_courses`.`course_id`='$course_id' and `student_courses`.`student_id`='$student_id';";
                     //$result = $conn->query($payofsubject);
                     echo $courses;
                     if ($conn->query($courses)==true){
                        $result = $conn->query($payofsubject);
                        $pay=$pay+$result->fetch_assoc()['pay_of_sub']; 
                        echo "SUCCESSFUL";
                        
                    }
                    else{
                        echo "ERROR";
                    }
                    $select_tutor="SELECT DISTINCT S.tutor_id FROM (SELECT tutor_id FROM student_tutor WHERE student_id='$student_id') as S join (SELECT P.tutor_id FROM tutor_courses as P join (SELECT course_id FROM courses WHERE class_id=(SELECT class_id FROM courses WHERE course_id='$course_id')) as Q WHERE P.course_id=Q.course_id AND P.course_id='$course_id')as F WHERE S.tutor_id=F.tutor_id;";
                    $result2 = mysqli_query($conn,$select_tutor);
                    $count2 = mysqli_num_rows($result2);
                    $row=[];
                    while ($row_element = mysqli_fetch_array($result2)){
                                        $row[]=$row_element;
                    }
                    print_r ($row);
                    for ($x1 =1; $x1 <= $count2; $x1++) {
                        $tutor_id=$row[$x1-1]['tutor_id'];
                        $delete_tutor="DELETE FROM student_tutor WHERE student_id='$student_id' and tutor_id='$tutor_id';";
                        
                        if ($conn->query($delete_tutor)){
                            echo "SUCCESSFUL";
                        }
                        else{
                            echo "error";
                        }
                    }
                }
            }
            $payofstudent= "SELECT stu_pay FROM student WHERE student_id='$student_id';";
            $result1 = $conn->query($payofstudent);
            $pay=$result1->fetch_assoc()['stu_pay']-$pay;
            $stu_pay="UPDATE `student` SET `stu_pay` = '$pay' WHERE `student`.`student_id` = '$student_id';";
            if ($conn->query($stu_pay)==true){
                echo "SUCCESSFULLY INSERTED";
              
            }
            else{
                echo "ERROR";
            }
            $conn->close();
                
}
header('Location: student-profile.php');
}
?>