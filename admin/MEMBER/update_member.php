<?php

extract($_POST);
if (isset($save)) {
	$memberId = intval($_GET['member_id']);

	mysqli_query($conn, "UPDATE member SET  
		`name` = '$name',
		`unp-gl` = '$unpgl',
		`c-gl` = '$cgl',
		`s/c` = '$sc',
		`amount` = '$amount',
		`or#` = '$or',
		`date` = '$date',
		`remarks` = '$remarks'
		WHERE `member_id`='$memberId'
		 ");

	$err = "<font color='blue'>Member Updated</font>";
	header('location:index.php?page=display_member');
	exit();
}

$sql = mysqli_query($conn, "SELECT * FROM member WHERE member_id='" . $_GET['member_id'] . "'");
$res = mysqli_fetch_array($sql);


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
			<input type="text" value="<?php echo $res['name']; ?>" name="name" class="form-control" readonly />
		</div>
	</div>


	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">UNP-GL</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['unp-gl']; ?>" name="unpgl" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">C-GL</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['c-gl']; ?>" name="cgl" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">S/C</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['s/c']; ?>" name="sc" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">AMOUNT</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['amount']; ?>" name="amount" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR#</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['or#']; ?>" name="or" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">DATE</div>
		<div class="col-sm-5">
			<input type="date" value="<?php echo $res['date']; ?>" name="date" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">REMARKS</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $res['remarks']; ?>" name="remarks" class="form-control" />
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