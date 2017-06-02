<?php
    include_once 'config.php';
    include_once 'course_model.php';

    $category_model = new category_model();

    $id = (isset($_GET['id']) && $_GET['id'] > 0) ? $_GET['id'] : 0;
    $action = (isset($_GET['action'])) ? $_GET['action'] : NULL;
    
    if($action=='delete' && $id>0){
        $category_model->deleteCategory($id);
        $id = 0;
    }  

    if ($_POST) {
        $postData = array('Name' => $_POST['courseName'],'IsActive' => isset($_POST['IsActive'])?1:0);
        
        if ($_POST['id'] > 0) {
            $category_model->editCategory($_POST['id'],$postData);    
        }
        else {
            $category_model->addCategory($postData);     
        }   
        header('location: course.php');
    }


    $categoryArray = $category_model->viewCategory();
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Courses</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script language="JavaScript" type="text/javascript">
                function checkDelete(CategoryId){
                    if(confirm('Are you sure to delete?') == true) {
                    window.location.href = "http://localhost/admin/course.php?action=delete&id="+CategoryId;
                    }
                }
        </script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
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
                                <a href="index.php">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Questions <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="addquestion.php">Add Quetions</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="question.php">Manage Quetions</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="index.php">User List</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <!--span-->
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li>
                            <a href="index.php"><i class="icon-chevron-right"></i> Dashboard</a>
                        </li>
                        <li class="active">
                            <a href="course.php"><i class="icon-chevron-right"></i> Courses</a>
                        </li>
                        <li>
                            <a href="difficulty.php"><i class="icon-chevron-right"></i> Difficulty Types</a>
                        </li>
                        <li>
                            <a href="question.php"><i class="icon-chevron-right"></i> Questions </a>
                        </li>
                    </ul>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="breadcrumb">
                                        <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <li class="active">
                                            <a href="index.php">Courses</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Add Courses</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal" method="POST">
                                     <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                      <fieldset>
                                        <legend>Add Courses</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Course Name</label>
                                             <div class="controls">
                                                <input type="text" name="courseName" value="<?php echo $id ? $categoryArray[$id]['Name'] : '';?>" class="span3 m-wrap" placeholder="Write Course Name" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="optionsCheckbox">Active</label>
                                          <div class="controls">
                                            <label class="uniform">
                                              <input class="uniform_on" type="checkbox" id="optionsCheckbox" name="IsActive" <?php echo ($id && $categoryArray[$id]['IsActive']) ? 'checked="checked"' : ''; ?>>
                                            </label>
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary"><?php echo $id ? 'Update':'Add Course'; ?></button>
                                          <button type="reset" class="btn">Reset</button>
                                          <a href="course.php"> <button type="button" class="btn">Cancel</button> </a>
                                        </div>
                                    </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <div class="row-fluid">
                        <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Manage Courses</div>
                                    <div class="pull-right"><span class="badge badge-info"><?php echo count($categoryArray); ?></span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Course Name</th>
                                                <th>IsActive</th>                             
                                                <th>Edit</th>                                 
                                                <th>Delete</th>                                      
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($categoryArray as $key => $value) {
                                        ?>                                            
                                            <tr>
                                                <td><?php echo $value['Name']; ?></td>
                                                <td><?php echo $value['IsActive']? 'Yes' : 'No'; ?></td>
                                                <td>
                                                    <a href="course.php?id=<?php echo $value['CategoryId']; ?>">
                                                    <img src="images/Edit.png" height="25px" width="25px"></a>
                                                </td>
                                                <td>
                                                    <a onclick="return checkDelete(<?php echo $value['CategoryId']; ?>);" style="cursor: pointer;">
                                                    <img src="images/DeleteRed.png" height="25px" width="25px"></a>
                                                </td>
                                            </tr>    
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/jquery.uniform.min.js"></script>
        <script src="vendors/chosen.jquery.min.js"></script>
        <script src="vendors/bootstrap-datepicker.js"></script>

        <script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<script type="text/javascript" src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
        
	<script src="assets/scripts.js"></script>
    </body>

</html>