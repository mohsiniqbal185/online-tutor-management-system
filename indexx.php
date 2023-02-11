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
<?php require '<partials/_header.php';?>
 
<div id="call-btn" class="visible-xs">
        <a class="btn" href="tel:03008962682">
            <span class="glyphicon glyphicon-earphone"></span> 0300-8962682
        </a>
    </div>
    <div id="xs-deliver" class="text-center visible-xs">* We Deliver</div>

    <!-- Start of main content -->
    <div id="main-content" class="container">
        <h2 style="text-align: center; color: rgb(9, 13, 66);  padding-bottom: 20px;"><b>Provide best education with finest tutors in town !</b></h2>
        <div id="myCarousel" class="carousel slide slider-container visible-sm visible-md visible-lg" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="images/nedpic_.png" alt="NED UNIVERSITY" style="width:100%;">
                </div>

                <div class="item">
                    <img src="images/fastpic_.png" alt="FAST NUCES" style="width:100%;">
                </div>

                <div class="item">
                    <img src="images/nustpic_.png" alt="NUST" style="width:100%;">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div style="padding-left: 0; padding-right:0;" class="jumbotron single-jumb-img visible-xs">
            <img src="nedpic_.png" alt="Ned university" class="img-responsive visible-xs">
        </div>
        <div id="home-tile" class="row">
        
            <div class="col-sm-6 col-md-4 col-sx-12" >
                       
                <a href="register.php">
                    <div id="sanitaryitems-tile"><span>Registration</span></div>
                </a>
            </div>
            <div class="col-sm-6 col-md-4 col-sx-12">
                <a href="loginform.php">
                    <div id="covers-tile"><span>Student Login</span></div>
                </a>
            </div>
            <div class="col-sm-6 col-md-4 col-sx-12">
                <a href="loginform.php">
                    <div id="map-tile"><span>Tutor Login</span></div>
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