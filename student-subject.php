              
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
    session_start();
     require '<partials/_header.php'?>
    
 <!-- Start of main content -->
<div class="container student-register-main">
        <h2 style="margin-bottom:30px; text-align: center; color:rgb(9, 13, 66);"><b>TO REGISTER AS A STUDENT PLEASE MARK THE SUBJECTS GIVEN BELOW</b></h2>
        <form class="form-horizontal"  method="POST"   >
           <div class="form-group">
         
                <label class="control-label col-sm-2" for="studyclass" style="color:rgb(9, 13, 66);">SELECT YOUR CLASS: </label>
                <div class="col-sm-10">
                    <button class='btn' name='class9' id='class9' value="SSC-I" style="background-color:rgb(9, 13, 66); margin-right: 20px;">Class 9</button>
                    <button class='btn' name='class10' id='class10' value="SSC-II" style="background-color:rgb(9, 13, 66); margin-right: 20px ;">Class 10</button>
                    <button class='btn' name='class11' id='class11' value="HSC-I" style="background-color:rgb(9, 13, 66); margin-right: 20px;">Class 11</button>
                    <button class='btn' name='class12' id='class12' value="HSC-II" style="background-color:rgb(9, 13, 66);">Class 12</button>
                </div>
            </div>
        </form>               

    <form class="form-horizontal"  method="GET"  action="addcourses.php" >
                
        <?php  
            include 'partials/_dbconnect.php';
            
        if(isset($_POST['class9'])){  
                $value = $_POST['class9'] ;
                //using SESSION to send the selected class variable to addcourses.php
                $_SESSION["value"]=$value; 
                //SEARCHING class9 courses from the database table 'courses'
                $sql="SELECT * FROM courses WHERE class_id='$value';";
                $run_query = mysqli_query($conn,$sql);
	            $count = mysqli_num_rows($run_query);
                while ($row_element = mysqli_fetch_array($run_query)){
                       $row[]=$row_element;
                }
                $x=1 ;                                  
                echo '              
            <div class="form-group">
                <label class="control-label col-sm-2" for="choosenSubjects">SUBJECTS FOR CLASS 9</label>
                <div class="col-sm-10">';
                    for ($x; $x <= $count; $x++){                         
                       echo '<div class="checkbox">
                               <label><input class="c9Subjects" type="checkbox" name="subject'.$x.'" value="'.$row[$x-1]["course_id"].'">'.$row[$x-1]["course_name"].'</label>
                               </div>';
                     }
                echo'</div>
            </div>';                 
        }

        elseif (isset($_POST['class10'])) {
                $value = $_POST['class10'] ;
                $_SESSION["value"]=$value;
                //SEARCHING class 10 courses from the database table 'courses'
                $sql="SELECT * FROM courses WHERE class_id='$value';";
                $run_query = mysqli_query($conn,$sql);
	            $count = mysqli_num_rows($run_query);
                while ($row_element = mysqli_fetch_array($run_query)){
                       $row[]=$row_element;
                }           
                 $x=1 ;                                  
                echo '              
                <div class="form-group">
                <label class="control-label col-sm-2" for="choosenSubjects">SUBJECTS FOR CLASS 10</label>
                    <div class="col-sm-10">';
                     for ($x; $x <= $count; $x++){                         
                         echo '<div class="checkbox">
                        <label><input type="checkbox" name="subject'.$x.'" value="'.$row[$x-1]["course_id"].'">'.$row[$x-1]["course_name"].'</label>
                        </div>';
                         }
                    echo'</div>
               </div>';                
        }

        elseif (isset($_POST['class11'])) {
                $value = $_POST['class11'] ;
                $_SESSION["value"]=$value;
                //SEARCHING class 11 courses from the database table 'courses'
                $sql="SELECT * FROM courses WHERE class_id='$value';";
                $run_query = mysqli_query($conn,$sql);
	            $count = mysqli_num_rows($run_query);
                while ($row_element = mysqli_fetch_array($run_query)){
                       $row[]=$row_element;
                }
                $x=1 ;                                  
                echo '              
                <div class="form-group">
                <label class="control-label col-sm-2" for="choosenSubjects">SUBJECTS FOR CLASS 11</label>
                     <div class="col-sm-10">';
                         for ($x; $x <= $count; $x++){
                            echo '<div class="checkbox">
                                <label><input class="c11Subjects" type="checkbox" name="subject'.$x.'" value="'.$row[$x-1]["course_id"].'">'.$row[$x-1]["course_name"].'</label>
                                </div>';
                    }
                echo'</div>
               </div>';
        }

        elseif (isset($_POST['class12'])) {
                $value = $_POST['class12'] ;
                $_SESSION["value"]=$value;
                //SEARCHING class 12 courses from the database table 'courses'
                $sql="SELECT * FROM courses WHERE class_id='$value';";
                $run_query = mysqli_query($conn,$sql);
	            $count = mysqli_num_rows($run_query);
                while ($row_element = mysqli_fetch_array($run_query)){
                       $row[]=$row_element;
                }
                $x=1 ;                                  
                echo '              
                <div class="form-group">
                     <label class="control-label col-sm-2" for="choosenSubjects">SUBJECTS FOR CLASS 12</label>
                    <div class="col-sm-10">';
                         for ($x; $x <= $count; $x++){                         
                         echo '<div class="checkbox">
                        <label><input class="c12Subjects" type="checkbox" name="subject'.$x.'" value="'.$row[$x-1]["course_id"].'">'.$row[$x-1]["course_name"].'</label>
                        </div>';
                         }
                    echo'</div>
               </div>';          
        }
        $conn->close();
           
            echo'<div class="form-group">
            <div class="col-sm-10">
                <div class="text-center">
                <button type="submit" name="proceed"  style="background-color:rgb(9, 13, 66);" class="btn" id="proceed"  > Next</button>
                </div>
            </div>  </div>'; ?>
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
        

        $('input.c11Subjects[type=checkbox]').change(function(e) {
            if ($('input.c11Subjects[type=checkbox]:checked').length > 6) {
                $(this).prop('checked', false)
                alert("allowed only 6");
            }
        })

        $('input.c12Subjects[type=checkbox]').change(function(e) {
            if ($('input.c12Subjects[type=checkbox]:checked').length > 6) {
                $(this).prop('checked', false)
                alert("allowed only 6");
            }
        })

    });
</script>


</body>

</html>