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
    <div class="container register-main">

        <div>
        <h2 style="text-align: center; color: rgb(9, 13, 66);"><b>DO YOU WANT TO REGISTER AS A STUDENT OR TUTOR?</b></h2>
        </div>
        <hr style="color: rgb(9, 13, 66);">
        <div class="row">
            <div class="col-md-6">
                <a href="student-register.php">
                    <div id="student-tile" style="margin-left: auto; margin-right: 22%;">
                        <img src="images/studentimg_.png" alt="Student" width="250" height="250">
                    </div>
                </a>
                   <div style="text-align: center;">
                    <a style="font-size: 1.5em;  color: rgb(9, 13, 66); " href="student-register.php">
                        <div>Register as a Student</div>
                    </a>
                    </div>
            </div>

            <div class="col-md-6">
                <a href="tutor-register.php">
                    <div id="student-tile" style="margin-left: auto; margin-right: 22%;">
                        <img src="images/teacherimgg_.png" alt="Student" width="250" height="250">
                    </div>
                </a>
                <a style="font-size: 1.5em;  color: rgb(9, 13, 66);" href="tutor-register.php">
                    <div style="text-align: center;">Register as a Tutor</div>
                </a>
            </div>
        </div>
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