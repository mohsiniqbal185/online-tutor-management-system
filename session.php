<?php
if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION["student_id"]);
    unset($_SESSION["tutor_id"]);
    header('location:indexx.php');
}
?>