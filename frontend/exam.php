<?php
    include_once 'config.php';

	$currentStep = 0;

    include_once '../product_model.php';
    $productModel = new product_model();

	include_once 'orderinvoice_model.php';
    $orderinvoice_model = new orderinvoice_model();

	include_once 'orderdetail_model.php';
    $orderdetail_model = new orderdetail_model();

	$order = $orderinvoice_model->getOrderById($_SESSION['orderId']);

	$products = $productModel->getProductsByCategoryAndDifficultyLevel($order['CategoryId'], $order['DifficultyId']);
    /*echo '<pre>';
    print_r($products);
    exit;*/

    if ($_POST) {
	    $product = $products[$_POST['productId']];
	    $totalScore = ($_POST['answer'] == $product['Answer']) ? 1 : 0;
        $currentStep = $_POST['currentStep'] + 1;

        $postData = array(
            'OrderId' => $_SESSION['orderId'],
            'ProductId' =>$_POST['productId'],
            'TotalScore' =>$totalScore,
		    'CreatedDateTime' => date('Y-m-d H:i:s'),
            'UpdatedDateTime' => date('Y-m-d H:i:s')
        );

        $orderdetail_model->addOrderDetail($postData);

        echo json_encode(['product' => $products[$currentStep]]);exit;
    }

    $product = $products[$currentStep];
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.submitAnswer').click(function(){
                    $.ajax({
                        method: "POST",
                        url: "http://localhost/Admin/frontend/exam.php",
                        dataType: 'json',
                        data: $('form').serialize(),
                        success: function(response) {
                            $('.product-question').html(response.product.Question);
                            $('.product-question .option1').text(response.product.OptionA);
                            $('.product-question .option2').text(response.product.OptionB);
                            $('.product-question .option3').text(response.product.OptionC);
                            $('.product-question .option4').text(response.product.OptionD);
                        },
                        error: function(response) {
                            console.log(response);  
                        }

                    });
                });
            });
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
                                    <div class="muted pull-left"><i class="icon-time"></i> Answer the Questions</div>
                                </div>
                                <div class="block-content collapse in">
                                    <form class="form-horizontal" method="POST">
                                        <input type="hidden" name="currentStep" value="<?php echo $currentStep; ?>" >
                                        <input type="hidden" name="productId" value="<?php echo $product['ProductId']; ?>" >
                                        <fieldset style="width: 90%;">
                                            <legend><i class="icon-question-sign" style="margin-top: 4px"></i> Questions</legend>
                                            <table class="table" style="margin-left: 10%;">
                                            <div>
                                                <label class="product-question" style="margin-left: 10%;"><?php echo $product['Question']; ?></label>
                                                <div class="controls product-answers">
                                                <tr>
                                                    <td style="border-top: aqua; width: 20%;">
                                                    <input type="radio" class="option1" name="answer[]" value="1"> <?php echo $product['OptionA']; ?>
                                                    </td>
                                                    <td style="border-top: aqua;">
                                                    <input type="radio" class="option2" name="answer[]" value="2"> <?php echo $product['OptionB']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: aqua;">
                                                    <input type="radio" class="option3" name="answer[]" value="3"> <?php echo $product['OptionC']; ?>
                                                    </td>
                                                    <td style="border-top: aqua;">
                                                    <input type="radio" class="option4" name="answer[]" value="4"> <?php echo $product['OptionD']; ?>
                                                    </td>
                                                </tr>    
                                                </div>
                                            </div>
                                            </table>
                                            <div class="form-actions">
                                                <button type="button" class="submitAnswer btn btn-primary">Submit Answer</button>
                                                <button type="reset" class="btn">Skip <i class="icon-forward"></i></button>
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
