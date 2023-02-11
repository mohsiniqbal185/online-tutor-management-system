<?php

use function PHPSTORM_META\map;

include 'partials/_dbconnect.php';

session_start();
$user =$_SESSION["tutor_id"];
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
       //If tutor wants to edit their details
    if(isset($_POST['snoEdit'])){
        $fname = $_POST['fnameEdit'];
        $lname = $_POST['lnameEdit'];
        $number = $_POST['numberEdit'];
        $number1 = $_POST['numberEdit2'];
        $qualification= $_POST["qlfc_Edit"];
        $contacts=array();
        //UPDATING tutor's data according to the changes entered by them
        $sql2 = "UPDATE tutor SET `fname` = '$fname' WHERE `tutor_id` = '$user';";
        $sql2a = "UPDATE tutor SET `lname` = '$lname' WHERE `tutor_id` = '$user';";
        $sql3 = "DELETE from tutor_contacts  WHERE `tutor_id` = '$user';";
        mysqli_query($conn,$sql3);
        $sql4 = "Insert into tutor_contacts(`tutor_id`,`contacts`) values('$user', ?)";
        $sql5 = "UPDATE tutor SET `qualification` = '$qualification' WHERE `tutor_id` = '$user';";
        if ($number != "") {
            $stmt = $conn->prepare($sql4); 
            $stmt->bind_param("s", $number);
            $stmt->execute();
        }
        
        if ($number1 != "") {
            $stmt = $conn->prepare($sql4); 
            $stmt->bind_param("s", $number1);
            $stmt->execute();
        }
        
        mysqli_query($conn,$sql2);
        mysqli_query($conn,$sql2a);
        mysqli_query($conn,$sql5);

        echo mysqli_error($conn);
    }
}
//SELECTING tutor's data from tutor and tutor_contacts table
$sql = "SELECT * FROM tutor WHERE tutor_id=?"; 
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$row = $result->fetch_assoc();
$contacts=array();
$sql1="SELECT * from tutor_contacts WHERE tutor_id='$user';";
$result4= mysqli_query($conn, $sql1);
while($row1=mysqli_fetch_assoc($result4)){
    
    $contacts[$row1['tcontact_id']] =$row1['contacts'];
}
//SELECTING tutor's payment date and status from tutor_payroll table
$sql5 = "SELECT * FROM tutor_payroll WHERE tutor_id = '$user';";
$result5 = mysqli_query($conn,$sql5);
//SELECTING data from tutor_courses and course table using an INNER JOIN
$sql6="SELECT * from tutor_courses AS E join courses AS M ON E.course_id=M.course_id where tutor_id='$user' ORDER BY E.course_id;";
$result6=mysqli_query($conn,$sql6);
$sql10="SELECT * from tutor_courses AS E join courses AS M ON E.course_id=M.course_id where tutor_id='$user' ORDER BY E.course_id;";
$result10=mysqli_query($conn, $sql10);

//SELECTING tutor's student from student_tutor table using an INNER JOIN
$sql7= "SELECT DISTINCT E.tutor_id, E.student_id,M.fname,M.lname FROM student_tutor as E join student as M on E.student_id = M.student_id where tutor_id='$user' ORDER BY M.fname;";
$result7=mysqli_query($conn,$sql7);


//COUNTING number of students taught by the tutor
$no_of_student="SELECT student_id FROM student_tutor WHERE tutor_id='$user';";
$run_query_pay = mysqli_query($conn,$no_of_student);
$count_of_students = mysqli_num_rows($run_query_pay);
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
   
    <!-- Start of main content for this page -->

    <div class="container student-profile-main">
        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Contact</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Modal Body -->
                        <form action="tutor-profile.php" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="snoEdit" id="snoEdit">
                                <label for="fnameEdit">First Name</label>
                                <input type="text" class="form-control" name="fnameEdit" id="fnameEdit"required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="snoEdit" id="snoEdit">
                                <label for="lnameEdit">Last Name</label>
                                <input type="text" class="form-control" name="lnameEdit" id="lnameEdit"required>
                            </div>
                        
                            <div class="form-group">
                                <label for="numberEdit">Phone#:</label>
                                <input type="tel"  pattern="[0-9]{4}-[0-9]{7}" class="form-control" name="numberEdit" id="numberEdit" required>
                                <small>Format: 03XX-XXXXXXX</small>
                            </div>
                            <div class="form-group">
                                <label for="numberEdit2">Emergency Phone#:</label>
                                <input type="tel"  pattern="[0-9]{4}-[0-9]{7}" class="form-control" name="numberEdit2" id="numberEdit2">
                                <small>Format: 03XX-XXXXXXX</small>
                            </div>
                            <div class="form-group">
                                <label for="qlfc_Edit">Qualification: </label>
                                <input type="text" class="form-control" name="qlfc_Edit" id="qlfc_Edit" required>
                            </div>
                            <button type="submit" name='submit' class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <div class="modal fade" id="editModal2" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Courses</h4>
                </div>
                <div class="modal-body">
                    <!-- Modal Body -->
                    <form action="tutor-deletecourse.php" method="GET">

                        <?php  $count4= mysqli_num_rows($result10);
                        while ($row_element4 = mysqli_fetch_array($result10)){
                        $row4[]=$row_element4;
                                 }
                        $_SESSION["Del_rec"]=$row4;
                        $x=1 ;                                  
                         
                        echo
                        '<div class="form-group">
                             <label class="control-label col-sm-2" for="choosenSubjects">Subjects</label>
                                <div class="col-sm-10">';
                                for ($x; $x <= $count4; $x++){                
                                echo '<div class="checkbox">
                                <label><input class="c12Subjects" type="checkbox" name="subject'.$x.'" value="'.$row4[$x-1]["course_id"].'">'.$row4[$x-1]["course_name"].'</label>
                                     </div>';
                                  }
                                 echo'   
                                </div>
                        </div>' ;?>
                  
                      <button type="submit" name='submit' class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

 <div class="modal fade" id="editModal3" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Courses</h4>
            </div>
            <div class="modal-body">
               <!-- Modal Body -->
                <form action="tutor-addcourses.php" method="POST">
                    <?php        
                     $sqlclass="SELECT * FROM `onlinetuitionmanagementsystem`.`class` ORDER BY class_id DESC;";
                   
                                 $run_queryclass = mysqli_query($conn,$sqlclass);
                                 $countclass = mysqli_num_rows($run_queryclass);
                                 while ($row_elementclass = mysqli_fetch_array($run_queryclass)){
                                        $rowclass[]=$row_elementclass;
                                 }
                    
                      $xclass=1 ;                                            
                    echo '              
                    <div class="form-group">'; 
                        for ($xclass; $xclass <= $countclass; $xclass++){
                            echo'<div class="col-sm-10">';

                            $class=$rowclass[$xclass-1]["class_id"];
                            
                            echo '   <h4>  Subjects for '.$rowclass[$xclass-1]["class_id"].'</h4>';
                            $addcourse="SELECT course_id,course_name,class_id FROM courses WHERE class_id='$class' AND course_id NOT IN (SELECT course_id FROM tutor_courses WHERE tutor_id='$user') ORDER BY course_id;";
                            $run_queryadd = mysqli_query($conn,$addcourse);
	                        $countadd = mysqli_num_rows($run_queryadd);
                            $rowadd=[]; 
                             
                        if($countadd ==0){
                            echo' <h4 class="modal-title">Already enrolled in all courses.You cannot choose any more subjects. </h4>
                    </div>';
                            } 
                        else{  
                             while ($row_elementadd = mysqli_fetch_array($run_queryadd)){
                                   $rowadd[]=$row_elementadd;
                               }
                            
                            $xadd=1 ;                                
                               for ($xadd; $xadd <= $countadd; $xadd++){
                           echo'<div class="checkbox">
                             <label><input class="c9Subjects" type="checkbox" name="subject'.$xadd.'" value="'.$rowadd[$xadd-1]["course_id"].'">'.$rowadd[$xadd-1]["course_name"].'</label>
                                     </div>';
                                 }
                                }
                             echo'</div>';}
                   echo' </div>';                  
                    echo'<button type="submit" name="proceed" class="btn btn-primary">Save Changes</button>'; ?>
                </form>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div> 

                                  <!-- Display Information -->

        <div class="text-center">
            <h2 style="text-align:center;font-size:300%;text-decoration-line: underline;font-family:courier;color: rgb(9, 13, 66);"> Welcome <?php echo $row['fname'].$row['lname'];?></h2>
        </div>
        <div>
            <h3 style="color: rgb(9, 13, 66);">Personal Information</h3>
        </div>

        <table class="table table-bordered" id='myTable'>
            <thead>
                <tr>
                              
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone#</th>
                    <th>Qualification</th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- Showing Personal Information from database -->
                    <td><?php echo $row['fname'];?></td>
                    <td><?php echo $row['lname'];?></td>
                    <td><?php echo $row['tutor_id']?></td>
                    <td><?php echo join(", ", array_values($contacts))?></td>
                    <td><?php echo $row['qualification']?></td>
                    <td> <button style=" background-color:#10102b; border-color:#10102b;" name='edit' class='edit btn btn-primary' id="">Edit</button>
                     

                </tr>
            </tbody>
        </table>

        <div>
            
                
                    <p style="font-size:120%;"><b>Salary status: </b> <?php $row2=mysqli_fetch_assoc($result5); echo $row2['status'];?></p>
                    <p style="font-size:120%;"><b>TOTAL SALARY: </b><?php echo $count_of_students*$row['tutor_pay'];?></p>
                    <p style="text-align:center;font-size:130%;text-decoration-line: underline; color: rgb(9, 13, 66);"><b> SUBJECTS TEACHING </b></p>
                    <br>
                    <table class="table table-hover" id='teachercourses'>
                    <thead>
                <tr>

                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Class</th>
                    
                </tr>
            </thead>
            <tbody>
                    <?php $num= 0; while($row=mysqli_fetch_assoc($result6)){
                        $num+=1;
                        echo '<tr><td>'.$row['course_id'].'</td><td>'.$row['course_name'].'</td><td>'.$row['class_id'].'</td></tr>';
                    }?>
                    </tbody>
                    </table>

                    <p> <button type="button" class="btn" data-toggle="modal" data-target="#editModal2">Delete Courses</button>
                        <button type="button" class="btn" data-toggle="modal" data-target="#editModal3" >Add Courses</button></p>

                    <p ><b style="font-size:120%;color: rgb(9, 13, 66);">Number of subjects teaching:</b><b><?php  echo ' '. $num; ?></b></p>
                    <p style="text-align:center;font-size:130%;text-decoration-line: underline; color: rgb(9, 13, 66);"><b>STUDENTS ENROLLED</b></p>
                    <br>
                    <table class="table table-condensed" id='teachercourses'>
                    <thead>
                <tr>

                    <th> Student Name</th>
                    <th>Student id</th>
                    
                </tr>
            </thead>
            <tbody>
                    <?php  while($row=mysqli_fetch_assoc($result7)){
                        
                        echo '<tr><td>'.$row['fname'].' '.$row['lname'].'</td><td>'.$row['student_id'].'</td></tr>';
                    }?>
                    </tbody>
                   </table>      
            </div>
</div>

    <!-- End of main content-->
    <div> </div>

    <?php require '<partials/_footer.php'?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        // Adds on-click listeners to every edit button which opens a modal for editing a contact
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit");
                tr = e.target.parentNode.parentNode;
                console.log(tr);
                // console.log(tr.getElementsByTagName("td")[0].textContent);
                fname = tr.getElementsByTagName("td")[0].textContent;
                lname = tr.getElementsByTagName("td")[1].textContent;

                numbers = tr.getElementsByTagName("td")[3].textContent.split(",");
                qualification = tr.getElementsByTagName("td")[4].textContent;
                console.log(fname,lname, numbers, qualification);
                fnameEdit.value = fname;
                lnameEdit.value = lname;
                numberEdit.value = numbers[0];
                numberEdit2.value = ""
                if (numbers.length > 1) {
                    numberEdit2.value = numbers[1]
                }
                qlfc_Edit.value = qualification;
                snoEdit.value = e.target.id;
                $('#editModal').modal('toggle');

            })
        })
    </script>


</body>

</html>