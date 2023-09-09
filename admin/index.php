<<<<<<< HEAD
<?php
session_start();
include('../connection.php');
$admin = $_SESSION['admin'];
if ($admin == "") {
	header('location:../index.php');
=======
<?php 
session_start();
include('../connection.php');
$admin= $_SESSION['admin'];
if($admin=="")
{
header('location:../index.php');
>>>>>>> eca9b32f00ce8c5b313e670d77e0cd0ea90f4bad
}
?>
<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>Admin Dashboard</title>

	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

	<link href="../css/dashboard.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
	
	<script src="../js/ie-emulation-modes-warning.js"></script>
	
</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" style="background:#f5f5f5;border-bottom:1px solid #eee;
">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">GROCERY LOAN</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">

					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
				<!--<form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>-->
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<!--<li ><a href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>-->
					<!-- find users' image if image not found then show dummy image -->


					<li><a href="#"><img style="border-radius:20px" src="../images/logo.jpg" width="100%" alt="not found" /></a></li>



					<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
					<li><a href="index.php?page=display_member"><span class="glyphicon glyphicon-user"></span> Members</a></li>
					<li><a href="index.php?page=display_sales_colln"><span class="glyphicon glyphicon-signal"></span> Sales Collection Summary</a></li>
					<li><a href="index.php?page=display_charged_cash"><span class="glyphicon glyphicon-credit-card"></span> Charged Cash Sales Summary</a></li>
					<li><a href="index.php?page=update_password"><span class="glyphicon glyphicon-lock"></span> Update Password</a></li>


				</ul>


			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<!-- container-->
				<?php
				@$page =  $_GET['page'];
				if ($page != "") {

					// CREATE MEMBER
					if ($page == "create_member") {
						include('MEMBER/create_member.php');
					}
					// READ/DISPLAY MEMBER
					if ($page == "display_member") {
						include('MEMBER/display_member.php');
					}
					// UPDATE MEMBER
					if ($page == "update_member") {
						include('MEMBER/update_member.php');
					}
					// SEARCH MEMBER
					if ($page == "search_member") {
						include('MEMBER/search_member.php');
					}

					// CREATE LOAN-MEMBER
					if ($page == "create_loan") {
						include('LOAN-MEMBER/create_loan.php');
					}
					// READ/DIPLAY LOAN-MEMBER
					if ($page == "display_loan") {
						include('LOAN-MEMBER/display_loan.php');
					}
					// UPDATE LOAN-MEMBER
					if ($page == "update_loan") {
						include('LOAN-MEMBER/update_loan.php');
					}
					// SEARCH LOAN-MEMBER
					if ($page == "search_loan") {
						include('LOAN-MEMBER/search_loan.php');
					}

					// CREATE SALES-COLLN
					if ($page == "create_sales_colln") {
						include('SALES-COLLN/create_sales_colln.php');
					}
					// READ/DISPLAY SALES-COLLN
					if ($page == "display_sales_colln") {
						include('SALES-COLLN/display_sales_colln.php');
					}
					// UPDATE SALES-COLLN
					if ($page == "update_sales_colln") {
						include('SALES-COLLN/update_sales_colln.php');
					}
					// SEARCH SALES-COLLN
					if ($page == "search_sales_colln") {
						include('SALES-COLLN/search_sales_colln.php');
					}

					// CREATE COLLN-TABLE
					if ($page == "create_colln_table") {
						include('COLLN-TABLE/create_colln_table.php');
					}
					// READ/DISPLAY COLLN-TABLE
					if ($page == "display_colln_table") {
						include('COLLN-TABLE/display_colln_table.php');
					}
					// UPDATE COLLN-TABLE
					if ($page == "update_colln_table") {
						include('COLLN-TABLE/update_colln_table.php');
					}




					if ($page == "display_charged_cash") {
						include('display_charged_cash.php');
					}



					if ($page == "update_password") {
						include('update_password.php');
					}
				} else {
					include('dashboard.php');
				}
				?>



			</div>
		</div>
	</div>

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="../js/vendor/jquery.min.js"><\/script>')
	</script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/vendor/holder.min.js"></script>
	<script src="../js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>
=======
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" style="background:#f5f5f5;border-bottom:1px solid #eee;
">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">GROCERY LOAN</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           
            <li><a href="logout.php">Logout</a></li>
          </ul>
          <!--<form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>-->
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <!--<li ><a href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>-->
			<!-- find users' image if image not found then show dummy image -->
			
			
            <li><a href="#"><img style="border-radius:20px" src="../images/adminicon.jpg" width="100" height="100" alt="not found"/></a></li>
			
			
			
	<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>		
	<li><a href="index.php?page=display_member"><span class="glyphicon glyphicon-user"></span>  Members</a></li>
    <li><a href="index.php?page=display_sales_colln"><span class="glyphicon glyphicon-signal"></span>  Sales Collection Summary</a></li>
	<li><a href="index.php?page=display_charged_cash"><span class="glyphicon glyphicon-credit-card"></span> Charged Cash Sales Summary</a></li>
	<li><a href="index.php?page=update_password"><span class="glyphicon glyphicon-lock"></span> Update Password</a></li>
			
            
          </ul>
         
         
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- container-->
		  <?php 
		@$page=  $_GET['page'];
		  if($page!="")
		  {

			// CREATE MEMBER
			if($page=="create_member") {
				include('MEMBER/create_member.php');
			}
			// READ/DISPLAY MEMBER
			if($page=="display_member") {
				include('MEMBER/display_member.php');
			}
			// UPDATE MEMBER
			if($page=="update_member") {
				include('MEMBER/update_member.php');
			}
			// SEARCH MEMBER
			if($page=="search_member") {
				include('MEMBER/search_member.php');
			}

			// CREATE LOAN-MEMBER
			if($page=="create_loan") {
				include('LOAN-MEMBER/create_loan.php');
			}
			// READ/DIPLAY LOAN-MEMBER
			if($page=="display_loan") {
				include('LOAN-MEMBER/display_loan.php');
			}
			// UPDATE LOAN-MEMBER
			if($page=="update_loan") {
				include('LOAN-MEMBER/update_loan.php');
			}
			// SEARCH LOAN-MEMBER
			if($page=="search_loan") {
				include('LOAN-MEMBER/search_loan.php');
			}

			// CREATE SALES-COLLN
			if($page=="create_sales_colln") {
				include('SALES-COLLN/create_sales_colln.php');
			}
			// READ/DISPLAY SALES-COLLN
			if($page=="display_sales_colln") {
				include('SALES-COLLN/display_sales_colln.php');
			}
			// UPDATE SALES-COLLN
			if($page=="update_sales_colln") {
				include('SALES-COLLN/update_sales_colln.php');
			}
			// SEARCH SALES-COLLN
			if($page=="search_sales_colln") {
				include('SALES-COLLN/search_sales_colln.php');
			}


		
			if($page=="create_colln_table") {
				include('create_colln_table.php');
			}

			if($page=="display_colln_table") {
				include('display_colln_table.php');
			}
			
			


			if($page=="display_charged_cash")
			{
				include('display_charged_cash.php');
			
			}
			
			
			
			if($page=="update_password")
			{
				include('update_password.php');
			
			}
			
			
		  }
		  
		  else
		  {
		 include('dashboard.php');
		 
		 }
		  ?>
		  

         
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
>>>>>>> eca9b32f00ce8c5b313e670d77e0cd0ea90f4bad
