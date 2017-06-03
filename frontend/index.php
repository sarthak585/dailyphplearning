<?php
    include_once 'config.php';
    include_once '../course_model.php';
    include_once '../difficulty_model.php';
    include_once 'orderinvoice_model.php';
    

    $difficultyModel = new difficulty_model();
    $difficultyArray = $difficultyModel->viewDifficulty();

    $category_model = new category_model();
    $categoryArray = $category_model->viewCategory(); 

    if ($_POST && $_POST['course'] > 0  && $_POST['difficulty'] > 0) {
        $postData = array('UserId' =>$_SESSION['id'],'CategoryId' =>$_POST['course'],'DifficultyId' =>$_POST['difficulty']);
        

        $json = json_encode($postData);
		
        setcookie(userData, $json, time() + (86400));

        header('location: confirmation.php');
    }    
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
                                        <a tabindex="-1" href="profile.php"><i class="icon-eye-open"></i> Profile</a>
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
                        <div class="span12">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><i class="icon-list-alt"></i> Test Selection</div>
                                </div>
                                <div class="block-content collapse in">
                                    <form class="form-horizontal" method="POST">
                                     <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                      <fieldset>
                                        <legend><i class="icon-th-list" style="margin-top: 4px;"></i> Select Test</legend>
                                        <div class="control-group">
                                          <label class="control-label">Course<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="course" required="required">
                                                  <option>--Select the Course--</option>
                                                  <?php foreach ($categoryArray as $key => $categoryValue) {?>
                                                    <option value="<?php echo $categoryValue['CategoryId']; ?>"> <?php echo $categoryValue['Name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group" >
                                          <label class="control-label">Difficulty Level<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="difficulty" required="required">
                                                  <option>--Select the Difficulty Level--</option>
                                                    <?php foreach ($difficultyArray as $key => $difficultyValue) { ?>
                                                        <option value="<?php echo $difficultyValue['DifficultyId']; ?>"><?php echo $difficultyValue['Name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Proceed</button>
                                          <button type="reset" class="btn">Reset</button>
                                        </div>
                                    </fieldset>
                                </form>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
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
