<?php

use function PHPSTORM_META\map;

include 'partials/_dbconnect.php';

session_start();
$user =$_SESSION["student_id"];
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //If student wants to edit their details
    if(isset($_POST['snoEdit'])){
        $fname = $_POST['fnameEdit'];
        $lname = $_POST['lnameEdit'];
        $number = $_POST['numberEdit'];
        $number1 = $_POST['numberEdit2'];
        $contacts=array();
        //UPDATING student's data according to the changes entered by them
        $sql2 = "UPDATE student SET `fname` = '$fname' WHERE `student_id` = '$user'";
        $sql2a = "UPDATE student SET `lname` = '$lname' WHERE `student_id` = '$user'";
        $sql3 = "DELETE from student_contacts  WHERE `student_id` = '$user'";
        mysqli_query($conn,$sql3);
        $sql4 = "Insert into student_contacts(`student_id`,`contacts`) values('$user', ?)";
        
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
        echo mysqli_error($conn);
    }
}
//SELECTING student's data from student and student_contacts table
$sql = "SELECT * FROM student WHERE student_id=?"; 
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$row = $result->fetch_assoc();
$contacts=array();
$sql1="SELECT * from student_contacts WHERE student_id='$user'";

$result4= mysqli_query($conn, $sql1);

while($row1=mysqli_fetch_assoc($result4)){
    
    $contacts[$row1['scontact_id']] =$row1['contacts'];
}
//SELECTING data from student_courses and course table using an INNER JOIN
$sql5="SELECT * from student_courses AS E join courses AS M ON E.course_id=M.course_id where student_id='$user' ORDER BY E.course_id";
$result5=mysqli_query($conn,$sql5);
$sql6="SELECT * from student_courses AS E join courses AS M ON E.course_id=M.course_id where student_id='$user'";
$result6=mysqli_query($conn, $sql6);
$sql10="SELECT * from student_courses AS E join courses AS M ON E.course_id=M.course_id where student_id='$user'";
$result10=mysqli_query($conn, $sql10);
//SELECTING student's payment date and status from student_finance table
$sql7 = "SELECT * from student_finance where student_id = '$user'";
$result7=mysqli_query($conn,$sql7);
//SELECTING student's tutors from student_tutor table using an INNER JOIN
$sql11= "SELECT DISTINCT E.tutor_id, E.student_id,M.fname,M.lname FROM student_tutor as E join tutor as M on E.tutor_id = M.tutor_id where student_id='$user' ORDER BY M.fname";
$result11=mysqli_query($conn,$sql11);


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
                        <h4 class="modal-title">Edit Details</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Modal Body -->
                        <form action="student-profile.php" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="snoEdit" id="snoEdit">
                                <label for="fnameEdit">First Name</label>
                                <input type="text" class="form-control" name="fnameEdit" id="fnameEdit"  required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="snoEdit" id="snoEdit">
                                <label for="lnameEdit">Last Name</label>
                                <input type="text" class="form-control" name="lnameEdit" id="lnameEdit"  required>
                            </div>
                            <div class="form-group">
                                <label for="numberEdit">Phone:</label>
                                <input type="tel"  pattern="[0-9]{4}-[0-9]{7}" class="form-control" name="numberEdit" id="numberEdit"  required>
                                <small>Format: 03XX-XXXXXXX</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="numberEdit2">Emergency Phone#:</label>
                                <input type="tel"  pattern="[0-9]{4}-[0-9]{7}" class="form-control" name="numberEdit2" id="numberEdit2">
                                <small>Format: 03XX-XXXXXXX</small>
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
                    <form action="delete-course.php" method="GET">

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
                <form action="addcourses.php" method="GET">
                    <?php   $class_id=$row4[0]["class_id"];         
                    $addcourse="SELECT course_id,course_name FROM courses WHERE class_id='$class_id' AND course_id NOT IN (SELECT course_id FROM student_courses WHERE student_id='$user');";
                    $run_query = mysqli_query($conn,$addcourse);
	                $counter = mysqli_num_rows($run_query);
                    while ($row_element = mysqli_fetch_array($run_query)){
                        $row[]=$row_element;
                     }
          
                      $x=1 ;                                            
                    echo '              
                    <div class="form-group">
                        <h4 class="modal-title">Subjects for '.$class_id.'</h4>';
                        if($counter ==0){
                            echo' <h4 class="modal-title">Already enrolled in all courses.You cannot choose any more subjects. </h4>
                    </div>';
                            }               
                        else{ 
                            echo'<div class="col-sm-10">';
                            for ($x; $x <= $counter; $x++){
                            echo '<div class="checkbox">
                             <label><input class="c9Subjects" type="checkbox" name="subject'.$x.'" value="'.$row[$x-1]["course_id"].'">'.$row[$x-1]["course_name"].'</label>
                                     </div>';
                                 }
                             echo'</div>
                    </div>';                  
                    echo'<button type="submit" name="proceed" class="btn btn-primary">Save Changes</button>'; }?>
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
        <h2 style="text-align:center;font-size:300%;text-decoration-line: underline;font-family:courier; color: rgb(9, 13, 66);">Welcome <?php echo $row['fname'].$row['lname'];?></h2>
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
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- Showing Personal Information from database -->
                    <td><?php echo $row['fname'];?></td>
                    <td><?php echo $row['lname'];?></td>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo join(", ", array_values($contacts))?></td>
                    <td> <button style=" background-color:#10102b; border-color:#10102b;" name='edit' class='edit btn btn-primary' id='edit' >Edit</button></td>
                   

                </tr>

            </tbody>
        </table>

        <div>

            <p><b>Fee status: </b><?php  $row2=mysqli_fetch_assoc($result7); echo $row2['status']; ?> </p>
            <p><b>Amount: </b> <?php echo $row['stu_pay']?></p>
            <p><b>Payment Date: </b><?php echo $row2['date']?></p>
            <p><b>Academic info: </b> </p>
            <p><b>Class: </b> <?php  $row3=mysqli_fetch_assoc($result6); echo $row3['class_id'];?></p>
            <p style="text-align:center;font-size:130%;text-decoration-line: underline;  color: rgb(9, 13, 66);"><b>COURSES ENROLLED</b></p>
                <table class="table table-hover" id='studentcourses'>
                <thead  >
                <tr>

                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Class</th>

                    
                </tr>
            </thead>
            <tbody>
                 <?php echo '<br>';?> </b> <?php while($row=mysqli_fetch_assoc($result5)){
                echo '<tr><td>'.$row['course_id'].'</td><td>'.$row['course_name'].'</td><td>'.$row['class_id'].'</td></tr>';
            }?>
                </tbody>
        </table>
                


            
            <p> <button type="button"class="btn" data-toggle="modal" data-target="#editModal2">Delete</button>
                <button type="button" class="btn" data-toggle="modal" data-target="#editModal3" >Add Courses</button></p>
            
            <p style="text-align:center;font-size:130%;text-decoration-line: underline; color: rgb(9, 13, 66);"><b>TUTORS</b></p> 
            <br>
                <table class="table table-condensed" id='tutor'>
                <thead>
                <tr>

                    <th> Tutor Name</th>
                    <th>Tutor id</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php  while($row=mysqli_fetch_assoc($result11)){
                        
                    echo '<tr><td>'.$row['fname'].' '.$row['lname'].'</td><td>'.$row['tutor_id'].'</td></tr>';
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
                numbers = tr.getElementsByTagName("td")[3].textContent.split(", ");
                console.log(fname,lname, numbers);
                fnameEdit.value = fname;
                lnameEdit.value = lname;
                numberEdit.value = numbers[0];
                numberEdit2.value = ""
                if (numbers.length > 1) {
                    numberEdit2.value = numbers[1]
                }
                snoEdit.value = e.target.id;
                $('#editModal').modal('toggle');

            })
        }) </script>
 

</body>

</html>