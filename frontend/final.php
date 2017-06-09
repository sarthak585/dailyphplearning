<?php
    include_once 'config.php';
    include_once '../course_model.php';
    include_once '../difficulty_model.php';
    include_once 'orderinvoice_model.php';    

    $orderinvoiceModel = new orderinvoice_model();
    $orderinvoiceModel->updateTotalScoreAndTotalTime($_SESSION['orderId']);

    $order = $orderinvoiceModel->getOrderById($_SESSION['orderId']);

    $seconds = $order['TotalTime'];

    $timeFormat = sprintf('%02d:%02d', floor($seconds / 60 % 60), floor($seconds % 60));

    $category_model = new category_model();
    $categoryArray = $category_model->getCategoryNameById($order['CategoryId']); 


    $difficultyModel = new difficulty_model();
    $difficultyArray = $difficultyModel->getDifficultyNameById($order['DifficultyId']);

    if($_POST) {
        if($_POST['sendEmail'] == true){
           $mail = mail($_SESSION['mail'],'Your Online Exam Certificate', $_POST['emailContent']);
           echo json_encode(array('success' => true));exit;
        }
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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
        <script type="text/javascript">
            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

            $(document).ready(function() {
                $('#btn').click(function () {
                    doc.fromHTML($('#content').html(), 15, 15, {
                        'width': 170,
                        'elementHandlers': specialElementHandlers
                    });
                    doc.save('certificate.pdf');
                 });
            });
            function printDiv(divID) {
                //Get the HTML of div
                var divElements = document.getElementById(divID).innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML = 
                  "<html><head><title></title></head><body>" + 
                  divElements + "</body></html>";

                //Print Page
                window.print();

                //Restore orignal HTML
                document.body.innerHTML = oldPage;

            }
            function sendEmail() {
                var divElements = $('#content').html();
                var emailContent = "<html><head><title></title></head><body>" + divElements + "</body></html>";
                $.ajax({
                        method: "POST",
                        url: "http://localhost/Admin/frontend/final.php",
                        dataType: 'json',
                        data: {sendEmail : true, emailContent : emailContent},
                        success: function(response) {
                            alert('mail Sent..!');
                        },
                        error: function(response) {
                            alert('mail  not Sent..!');  
                        }
                    });
            }
        </script>
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
                                <a href="index.php">Home</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <button class="btn btn-primary pull-right" style="margin-left: 5px;" onclick="javascript:sendEmail()"><i class="icon-envelope icon-white"></i> Mail</button>
                <div id="editor"></div> 
                <button id="btn" class="btn btn-info pull-right" style="margin-left: 5px;"><i class="icon-download-alt icon-white"></i> Download</button>
                <button class="btn btn-success pull-right" onclick="javascript:printDiv('content')"><i class="icon-print icon-white"></i> Print</button>
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- block -->
                            <div style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878; margin: auto; margin-top: 2%;">
                                <div style="width:750px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
                                    <br><br>
                                    <span style="font-size:50px; font-weight:bold; font-family:Copperplate Gothic Light;"><u>Passing Certificate</u></span>
                                    <br><br><br>
                                    <span style="font-size:25px"><i>This is to certify that</i></span>
                                    <br><br>
                                    <span style="font-size:30px"><b><?php echo "{$_SESSION['fname']} {$_SESSION['lname']}"; ?></b></span><br/><br/>
                                    <span style="font-size:25px"><i>has passed the exam of the course</i></span> <br/><br/>
                                    <span style="font-size:30px"><?php echo $categoryArray['Name'];?></span> <br/><br/>
                                    <span style="font-size:20px">with the difficulty level of <b><?php echo $difficultyArray['Name'];?></b></span> <br/><br/>
                                    <span style="font-size:20px">with score of <b><?php echo $order['TotalScore']; ?></b> out of <b>10</b> in overall <b><?php echo $timeFormat; ?></b> (min:sec) time </span> <br/><br/><br/><br/>
                                    <span style="font-size:25px"><i>dated</i></span><br><br>
                                    <span style="font-size:30px"><?php echo date('M j, Y', strtotime($order['CreatedDateTime']));?></span>
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
