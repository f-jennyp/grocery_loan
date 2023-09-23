<?php
extract($_POST);
if (isset($save)) {
	if ($np == "" || $cp == "" || $op == "") {
		$err = "<font color='red'>Fill all the fields first</font>";
	} else {
		// Hash the old password from the form
		$hashed_old_password = sha1($op); // You can use a suitable hashing algorithm here

		$sql = mysqli_query($conn, "select * from admin where pass='$hashed_old_password'");
		$r = mysqli_num_rows($sql);
		if ($r == true) {
			if ($np == $cp) {
				// Hash the new password
				$hashed_new_password = sha1($np); // You can use the same hashing algorithm as above

				// Update the password in the database
				$sql = mysqli_query($conn, "update admin set pass='$hashed_new_password' where user='$admin'");

				$err = "<font color='blue'>Password updated</font>";
			} else {
				$err = "<font color='red'>New password not matched with Confirm Password</font>";
			}
		} else {
			$err = "<font color='red'>Wrong Old Password</font>";
		}
	}
}
?>

<h2>Update Password</h2>
<form method="post">

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<?php echo @$err; ?>
		</div>
	</div>



	<div class="row" style="margin-top:15px">
		<div class="col-sm-4">Enter Your Old Password</div>
		<div class="col-sm-5">
			<input type="password" name="op" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:15px">
		<div class="col-sm-4">Enter New Password</div>
		<div class="col-sm-5">
			<input type="password" name="np" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:15px">
		<div class="col-sm-4">Confirm Password</div>
		<div class="col-sm-5">
			<input type="password" name="cp" class="form-control" />
		</div>
	</div>
	<div class="row" style="margin-top:15px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">


			<input type="submit" value="Update Password" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
	</div>
	
</form>


<div style="text-align: center; margin-top: 50px; color:gray; font-size: 11px">
    &copy; 2023 All Rights Reserved.
</div>

