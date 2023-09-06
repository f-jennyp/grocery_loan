<?php
$err = ''; // Initialize the error message

if (isset($_POST['save'])) {
	// Include database connection and sanitize $_POST data
	// Use prepared statements to prevent SQL injection
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$unpgl = intval($_POST['unpgl']);
	$cgl = intval($_POST['cgl']);
	$sc = intval($_POST['sc']);
	$amount = floatval($_POST['amount']);
	$or = intval($_POST['or']);
	$date = $_POST['date']; // Ensure you validate and format the date properly
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

	$memberId = intval($_GET['member_id']); // Sanitize the member ID

	// Update query with placeholders for prepared statement
	$updateQuery = "UPDATE `member` SET `name`=?, `unp-gl`=?, `c-gl`=?, `s/c`=?, `amount`=?, `or#`=?, `date`=?, `remarks`=? WHERE `member_id`=?";

	// Prepare the query
	$stmt = mysqli_prepare($conn, $updateQuery);

	// Binding parameters
	mysqli_stmt_bind_param($stmt, "siiiidsii", $name, $unpgl, $cgl, $sc, $amount, $or, $date, $remarks, $memberId);

	if (mysqli_stmt_execute($stmt)) {
		$err = "<font color='blue'>Member Updated</font>";
		header('location:index.php?page=display_gl_member');
		exit(); // Add an exit() after header to stop script execution
	} else {
		$err = "<div class='alert alert-danger'>Error updating member: " . mysqli_error($conn) . "</div>";
	}

	mysqli_stmt_close($stmt);
}

$memberId = intval($_GET['member_id']); // Sanitize the member ID

// Fetch member data for the given member_id
$sql = mysqli_query($conn, "SELECT * FROM member WHERE member_id='$memberId'");
$r = mysqli_fetch_array($sql);
?>

<h2 align="center">Update Member | Grocery Loan, RO1</h2>
<form method="post">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<?php echo @$err; ?>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Name</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r['name']; ?>" name="name" class="form-control" readonly/>
		</div>
	</div>


	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">UNP-GL</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $r['unp-gl']; ?>" name="unpgl" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">C-GL</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $r['c-gl']; ?>" name="cgl" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">S/C</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $r['s/c']; ?>" name="sc" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">AMOUNT</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $r['amount']; ?>" name="amount" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR#</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo$r['or#']; ?>" name="or" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">DATE</div>
		<div class="col-sm-5">
			<input type="date" value="<?php echo $r['date']; ?>" name="date" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">REMARKS</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r['remarks']; ?>" name="remarks" class="form-control" />
		</div>
	</div>


	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<input type="submit" value="Update Member" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
	</div>
</form>