<?php
session_start();

	include('connection.php');
		extract($_POST);
	if(isset($login))
	{
        $pass=sha1($pass);
		$que=mysqli_query($conn,"select * from admin where user='$email' and pass='$pass'");
		$row=mysqli_num_rows($que);
		if($row)
			{	
				$_SESSION['admin']=$email;
				header('location:admin');
			}
		else
			{
				$err="<font color='red'>Wrong Email or Password!</font>";
			}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<<<<<<< HEAD
    <title>GL - Login Panel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

=======
    <title>SLMS - Login Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
>>>>>>> eca9b32f00ce8c5b313e670d77e0cd0ea90f4bad

</head>

<body style="background:#CCCCCC">

    <div class="container" >
        <div class="row" style="margin-top:20px">
            <div class="col-md-4 col-md-offset-4">
<<<<<<< HEAD
            <h4 class="text-center">Grocery Loan</h4>
=======
            <h4 class="text-center">Simple Loan Management System</h4>
>>>>>>> eca9b32f00ce8c5b313e670d77e0cd0ea90f4bad
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Log In to continue...</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" name="email" type="email" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pass" type="password" required>
                                </div>
                                
                                
								<div class="form-group">
                                    <input name="login" type="submit" value="Login" class="btn btn-md btn-success btn-block">
                                </div>
								
								<div class="form-group">
                                    <label>
                                        <?php echo @$err;?>
                                    </label>
                                </div>
								
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <script src="css/jquery.min.js"></script>
    <script src="css/bootstrap.min.js"></script>
    <script src="css/metisMenu.min.js"></script>
=======
    <!-- jQuery -->
    <script src="css/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="css/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="css/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
>>>>>>> eca9b32f00ce8c5b313e670d77e0cd0ea90f4bad
    <script src="css/sb-admin-2.js"></script>

</body>

</html>
