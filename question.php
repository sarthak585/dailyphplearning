<?php
    include_once 'config.php';
    include_once 'product_model.php';
    include_once 'course_model.php';
    include_once 'difficulty_model.php';

    $difficultyModel = new difficulty_model();
    $difficultyArray = $difficultyModel->viewDifficulty();

    $category_model = new category_model();
    $categoryArray = $category_model->viewCategory(); 

    $product_model = new product_model();
    
    $id = (isset($_GET['id']) && $_GET['id'] > 0) ? $_GET['id'] : 0;
    $action = (isset($_GET['action'])) ? $_GET['action'] : NULL;

    if($action=='delete' && $id>0){
        $product_model->deleteProduct($id);
        $id = 0;
    }    
    
    if ($_POST) {
        $postData = array('CategoryId' =>$_POST['course'],'DifficultyId' =>$_POST['difficulty'],'Question' =>$_POST['question'],'OptionA' => $_POST['optionA'],'OptionB' => $_POST['optionB'],'OptionC' => $_POST['optionC'],'OptionD' => $_POST['optionD'],'Answer' => $_POST['answer']);
        if ($_POST['id'] > 0) {
            $product_model->editProduct($_POST['id'],$postData);    
        }
        else {
            $product_model->addProduct($postData);     
        }
       
                
    }
    $productArray = $product_model->viewProduct(); 

?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Questions</title>
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
            function checkDelete(productId){
                if(confirm('Are you sure to delete?') == true) {
                window.location.href = "http://localhost/admin/question.php?action=delete&id="+productId;
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
                    <a class="brand" href="index.php">Online Exam</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $_SESSION['fname']; ?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#"><i class="icon-eye-open"></i> Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="logout.php"><i class="icon-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="index.php">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                            <li>
                                                <a href="#">Reports</a>
                                            </li>
                                            <li>
                                                <a href="#">Logs</a>
                                            </li>
                                            <li>
                                                <a href="#">Errors</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">SEO Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                </ul>
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
                                    <li>
                                        <a tabindex="-1" href="#">Search</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Permissions</a>
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
                        <li class="active">
                            <a href="index.php"><i class="icon-chevron-right"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="course.php"><i class="icon-chevron-right"></i> Courses</a>
                        </li>
                        <li>
                            <a href="difficulty.php"><i class="icon-chevron-right"></i> Difficulty Types</a>
                        </li>
                        <li>
                            <a href="question.php"><i class="icon-chevron-right"></i> Questions </a>
                        </li>
                        <li>
                            <a href="tables.html"><i class="icon-chevron-right"></i> Tables</a>
                        </li>
                        <li>
                            <a href="buttons.html"><i class="icon-chevron-right"></i> Buttons & Icons</a>
                        </li>
                        <li>
                            <a href="editors.html"><i class="icon-chevron-right"></i> WYSIWYG Editors</a>
                        </li>
                        <li>
                            <a href="interface.html"><i class="icon-chevron-right"></i> UI & Interface</a>
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
                                            <a href="index.php">Questions</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                  </div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Add Questions</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal" method="POST">
                                     <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                      <fieldset>
                                        <legend>Add Questions</legend>
                                        <div class="control-group">
                                          <label class="control-label">Course<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="course" value="">
                                                  <option>--Select the Course--</option>
                                                  <?php foreach ($categoryArray as $key => $categoryValue) {?>
                                                    <option value="<?php echo $categoryValue['CategoryId']; ?>" <?php echo ($id && $productArray[$id]['CategoryId']==$categoryValue['CategoryId']) ? 'selected' : ''; ?> > <?php echo $categoryValue['Name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Difficulty Type<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="difficulty" value="<?php echo $id ? $productArray[$id]['DifficultyId'] : '';?>">
                                                  <option>--Select the Difficulty Level--</option>
                                                    <?php foreach ($difficultyArray as $key => $difficultyValue) { ?>
                                                        <option value="<?php echo $difficultyValue['DifficultyId']; ?>" <?php echo ($id && $productArray[$id]['DifficultyId']==$difficultyValue['DifficultyId']) ? 'selected' : ''; ?>><?php echo $difficultyValue['Name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Question</label>
                                            <div class="controls">
                                                <textarea class="input-xlarge focused" name="question" id="focusedInput" placeholder="Write the question..." style="margin: 0px; width: 473px; height: 115px"><?php echo $id ? $productArray[$id]['Question'] : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionA<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionA" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionA'] : '';?>" placeholder="Write OptionA" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionB<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionB" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionB'] : '';?>" placeholder="Write OptionB"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionC<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionC" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionC'] : '';?>" placeholder="Write OptionC"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionD<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionD" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionD'] : '';?>" placeholder="Write OptionD"/>
                                            </div>
                                        </div>                                        
                                        <div class="control-group">
                                          <label class="control-label">Answer<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="answer" value="<?php echo $id ? $productArray[$id]['Answer'] : '';?>">
                                                  <option>--Select the Answer--</option>
                                                  <option value="1" <?php echo ($id && $productArray[$id]['Answer']==1) ? 'selected' : ''; ?>>OptionA</option>
                                                  <option value="2" <?php echo ($id && $productArray[$id]['Answer']==2) ? 'selected' : ''; ?>>OptionB</option>
                                                  <option value="3" <?php echo ($id && $productArray[$id]['Answer']==3) ? 'selected' : ''; ?>>OptionC</option>
                                                  <option value="4" <?php echo ($id && $productArray[$id]['Answer']==4) ? 'selected' : ''; ?>>OptionD</option>
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary"><?php echo $id ? 'Save':'Add Question'; ?></button>
                                          <button type="reset" class="btn">Cancel</button>
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
                                    <div class="muted pull-left">Manage Questions</div>
                                    <div class="pull-right"><span class="badge badge-info"><?php echo count($productArray); ?></span>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Course Name</th>
                                                <th>Difficulty Level</th>
                                                <th>Question</th>
                                                <th>OptionA</th>
                                                <th>OptionB</th>
                                                <th>OptionC</th>
                                                <th>OptionD</th>
                                                <th>Answer</th>                                            
                                                <th>Edit</th>                                  
                                                <th>Delete</th>                                  
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($productArray as $key => $value) {
                                        ?>                                            
                                            <tr>

                                                <td><?php echo $categoryArray[$value['CategoryId']]['Name']; ?></td>
                                                <td><?php echo $difficultyArray[$value['DifficultyId']]['Name']; ?></td>
                                                <td><?php echo $value['Question']; ?></td>
                                                <td><?php echo $value['OptionA']; ?></td>
                                                <td><?php echo $value['OptionB']; ?></td>
                                                <td><?php echo $value['OptionC']; ?></td>
                                                <td><?php echo $value['OptionD']; ?></td>
                                                <td><?php  if($value['Answer']==1){
                                                                echo $value['OptionA'];
                                                            }
                                                            else if($value['Answer']==2){
                                                                echo $value['OptionB'];
                                                            }
                                                            else if($value['Answer']==3){
                                                                echo $value['OptionC'];
                                                            }
                                                            else if($value['Answer']==4){
                                                                echo $value['OptionD'];
                                                            } 
                                                        ?>
                                                </td>
                                                <td>
                                                    <a href="question.php?id=<?php echo $value['ProductId']; ?>">
                                                    <img src="images/Edit.png" height="25px" width="25px"></a>
                                                </td>
                                                <td>
                                                    <a onclick="return checkDelete(<?php echo $value['ProductId']; ?>);" style="cursor: pointer;">
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
	<script src="assets/form-validation.js"></script>
        
	<script src="assets/scripts.js"></script>
        <script>

	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
	

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>