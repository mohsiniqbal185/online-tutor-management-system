<nav id="header-nav" class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">

                    <a href="indexx.html" class="pull-left visible-md visible-lg">
                        <div id="logo-img" alt="Logo-img"></div>
                    </a>
                    <div class="navbar-brand">
                        <a href="indexx.html" alt="Online Tuition Management System">
                            <h1>
                                <emph>NED TUTORS</emph>
                            </h1>
                        </a>
                        <p style="color: aliceblue;">Quality Education providers</p>
                    </div>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapsable-nav">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                </div>
                <div id="collapsable-nav" class="collapse navbar-collapse">
                    <ul id="nav-list" class="nav navbar-nav navbar-right">
                        <li>
                            
                                <?php
                                    if (isset($_SESSION["student_id_login"]) or isset($_SESSION["tutor_id_login"]) ){
                             
                                     //  echo' <a href="indexx.php">
                                       
                                     echo'  <a><span class="glyphicon glyphicon-th-list"></span><br class="hidden-xs"> <form action="session.php" method="GET"><div class="form-group"><button style="background-color:#1a1a1d;" type="submit" name="logout" id="logout" class="btn" >Logout</button></div></form></a>';
                                      
                                    } 
                                  
                                   else { 
                                   echo ' <a href="loginform.php">
                                        <span class="glyphicon glyphicon-th-list"></span><br class="hidden-xs">Login</a>';
                                         } ?>
                            
                        </li>
                        <li>
                            <a >
                                <span class="glyphicon glyphicon-info-sign"></span><br class="hidden-xs">About</a>
                        </li>
                        <li>
                            <a >
                                <span class="glyphicon glyphicon-certificate"></span><br class="hidden-xs">Awards</a>
                        </li>
                        
                    </ul>

                </div>
            </div>
        </nav>
