<?php
if (isset($_POST['save'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $unpgl = intval($_POST['unpgl']);
    $cgl = intval($_POST['cgl']);
    $sc = intval($_POST['sc']);
    $amount = floatval($_POST['amount']);
    $or = intval($_POST['or']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    if (empty($name)) {
        $err = "<font color='red'>Fill in all the required fields</font>";
    } else {
        $sql = mysqli_query($conn, "SELECT * FROM member WHERE name='$name'");
        $r = mysqli_num_rows($sql);
        if ($r != true) {
            mysqli_query($conn, "INSERT INTO member VALUES('', '$name', '$unpgl', '$cgl', '$sc', '$amount', '$or', now(), '$remarks')");

            $newTableName = str_replace(' ', '_', $name); // Replace spaces with underscores
            $loanTableQuery = "CREATE TABLE $newTableName (
                id INT AUTO_INCREMENT PRIMARY KEY,
                date DATE,
                loan_amount FLOAT,
				payment_amount FLOAT,
                or_num INT,
				or_date DATE,
				amount_balance FLOAT,
				loan_balance FLOAT,
				sc_starts VARCHAR(255), 
				four_percent FLOAT,
				sc_dates VARCHAR(255),
				months INT,
				four_percent_sc FLOAT,
				sc_payments FLOAT,
				sc_payments_or_num INT,
				sc_payments_date DATE,
				sc_balance FLOAT
            )";
            mysqli_query($conn, $loanTableQuery);

            $err = "<div class='alert alert-success'>New member has been added successfully</div>";
        } else {
            $err = "<div class='alert alert-danger'>This member already exists</div>";
        }
    }
}
?>

<h2 class="text-center">Add New Member | Grocery Loan, RO1</h2>
<form method="post">

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<?php echo @$err; ?>
		</div>
	</div>



	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Member's Name</div>
		<div class="col-sm-5">
			<input type="text" name="name" class="form-control" required />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">UNP-GL</div>
		<div class="col-sm-5">
			<input type="number" name="unpgl" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">C-GL</div>
		<div class="col-sm-5">
			<input type="number" name="cgl" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">S/C</div>
		<div class="col-sm-5">
			<input type="number" name="sc" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">AMOUNT</div>
		<div class="col-sm-5">
			<input type="number" name="amount" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR#</div>
		<div class="col-sm-5">
			<input type="number" name="or" class="form-control" />
		</div>
	</div>


	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">DATE</div>
		<div class="col-sm-5">
			<input type="date" name="date" min="2016-01-01" class="form-control" />

		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">REMARKS</div>
		<div class="col-sm-5">
			<input type="text" name="remarks" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">


			<input type="submit" value="Add New Member" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
		<div class="col-sm-4"></div>
	</div>
</form>