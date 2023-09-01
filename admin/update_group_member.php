<?php
if (isset($_POST['save'])) {
	extract($_POST); // Extracting POST data after checking the 'save' button

	$memberId = intval($_GET['member_id']); // Sanitizing the member ID

	// Update query with placeholders for prepared statement
	$updateQuery = "UPDATE member SET name=?, `unp-gl`=?, `c-gl`=?, `s/c`=?, amount=?, `or#`=?, date=?, remarks=? WHERE member_id=?";

	// Prepare the query
	$stmt = mysqli_prepare($conn, $updateQuery);

	// Binding parameters
	mysqli_stmt_bind_param($stmt, "siiiidsii", $name, $unpgl, $cgl, $sc, $amount, $or, $date, $remarks, $memberId);

	if (mysqli_stmt_execute($stmt)) {
		$err = "<font color='blue'>Member Updated</font>";
	} else {
		$err = "<div class='alert alert-danger'>Error updating member: " . mysqli_error($conn) . "</div>";
	}

	mysqli_stmt_close($stmt);
}

$memberId = intval($_GET['member_id']); // Sanitizing the member ID

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
			<input type="text" value="<?php echo $r[1]; ?>" name="name" class="form-control" required/>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">UNP-GL</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r[2]; ?>" name="unpgl" class="form-control" required/>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">C-GL</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r[3]; ?>" name="cgl" class="form-control" required/>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">S/C</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r[4]; ?>" name="sc" class="form-control" required/>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">AMOUNT</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r[5]; ?>" name="amount" class="form-control" required/>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR#</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r[6]; ?>" name="or" class="form-control" required/>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">DATE</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r[7]; ?>" name="date" class="form-control" required/>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">REMARKS</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $r[8]; ?>" name="remarks" class="form-control" required/>
		</div>
	</div>

	<?php
	$q1 = mysqli_query($conn, "select * from groups");
	while ($r1 = mysqli_fetch_assoc($q1)) {

	}
	?>


	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<input type="submit" value="Update Member" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
	</div>
</form>