<?php
session_start();
include('../connection.php');
$admin = $_SESSION['admin'];
if ($admin == "") {
	header('location:../index.php');
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
					// SEARCH COLLN-TABLE
					if ($page == "search_colln_table") {
						include('COLLN-TABLE/search_colln_table.php');
					}

					// CREATE CHARGED-CASH
					if ($page == "create_charged_cash") {
						include('CHARGED-CASH/create_charged_cash.php');
					}
					// READ/DISPLAY CHARGED-CASH
					if ($page == "display_charged_cash") {
						include('CHARGED-CASH/display_charged_cash.php');
					}
					// UPDATE CHARGED-CASH
					if ($page == "update_charged_cash") {
						include('CHARGED-CASH/update_charged_cash.php');
					}
					// SEARCH CHARGED-CASH
					if ($page == "search_charged_cash") {
						include('CHARGED-CASH/search_charged_cash.php');
					}


					// CREATE CASH-TABLE
					if ($page == "create_cash_table") {
						include('CASH-TABLE/create_cash_table.php');
					}
					// READ/DISPLAY CASH-TABLE
					if ($page == "display_cash_table") {
						include('CASH-TABLE/display_cash_table.php');
					}
					// UPDATE CASH-TABLE
					if ($page == "update_cash_table") {
						include('CASH-TABLE/update_cash_table.php');
					}
					// SEARCH CASH-TABLE
					if ($page == "search_cash_table") {
						include('CASH-TABLE/search_cash_table.php');
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