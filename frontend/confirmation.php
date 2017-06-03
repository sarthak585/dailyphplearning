<?php
    include_once 'config.php';
    include_once '../course_model.php';
    include_once '../difficulty_model.php';
    include_once 'orderinvoice_model.php';

    $category_model = new category_model();
    $categoryArray = $category_model->viewCategory();

    $difficultyModel = new difficulty_model();
    $difficultyArray = $difficultyModel->viewDifficulty();

    $orderinvoice_model = new orderinvoice_model();
       
    $cookie = $_COOKIE['userData'];
    $cookie = stripslashes($cookie);
    $postData = json_decode($cookie, true);

    $orderId = $orderinvoice_model->addOrderinvoice($postData);
    $_SESSION['orderId'] = $orderId;
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Online Exam Portal</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                <!--
                <div class="container-fluid" style="background: rgba(0, 0, 0, 0) -moz-linear-gradient(center bottom , #4d5b76 0%, #6f80a1 100%) repeat scroll 0 0;">
                -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand">Online Exam</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $_SESSION['fname']; ?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="icon-eye-open"></i> Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="logout.php"><i class="icon-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li>
                                <a href="index.php"><i class="icon-home"></i> Home</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-check"></i> Test Confirmation</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <table class="table table-bordered">
                                      <tbody>
                                        <tr>
                                          <td style="width: 20%;"><b>Course</b></td>
                                          <td><?php echo $categoryArray[$postData['CategoryId']]['Name'];  ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Difficulty Level</b></td>
                                          <td><?php echo $difficultyArray[$postData['DifficultyId']]['Name'];  ?></td>
                                        </tr>
                                        <tr>
                                          <td><b>Number of questions in test</b></td>
                                          <td>10</td>
                                        </tr>
                                        <tr>
                                          <td><b>Time Duration</b></td>
                                          <td>20 Minutes</td>
                                        </tr>

                                      </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                              <a href="exam.php"><button type="submit" class="btn btn-primary" value="submit"><i class="icon-thumbs-up icon-white"></i> Start Now.!</button></a>
                              <a href="index.php"><button type="reset" class="btn">Cancel</button></a>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>    
            <hr>
            <footer>
                <p>&copy; Sarthak Shah 2017</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="assets/scripts.js"></script>
    </body>

</html>
