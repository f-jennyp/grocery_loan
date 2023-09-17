<?php
if (isset($_GET['table'])) {
	$tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));

	if (isset($_POST['save'])) {

		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$loan_amount = mysqli_real_escape_string($conn, $_POST['loan_amount']);
		$payment_amount = mysqli_real_escape_string($conn, $_POST['payment_amount']);
		$or_num = mysqli_real_escape_string($conn, $_POST['or_num']);
		$or_date = mysqli_real_escape_string($conn, $_POST['or_date']);
		$amount_balance = mysqli_real_escape_string($conn, $_POST['amount_balance']);
		$loan_balance = mysqli_real_escape_string($conn, $_POST['loan_balance']);
		$sc_starts = mysqli_real_escape_string($conn, $_POST['sc_starts']);
		$four_percent = mysqli_real_escape_string($conn, $_POST['four_percent']);
		$sc_dates = mysqli_real_escape_string($conn, $_POST['sc_dates']);
		$months = mysqli_real_escape_string($conn, $_POST['months']);
		$four_percent_sc = mysqli_real_escape_string($conn, $_POST['four_percent_sc']);
		$sc_payments = mysqli_real_escape_string($conn, $_POST['sc_payments']);
		$sc_payments_or_num = mysqli_real_escape_string($conn, $_POST['sc_payments_or_num']);
		$sc_payments_date = mysqli_real_escape_string($conn, $_POST['sc_payments_date']);
		$sc_balance = mysqli_real_escape_string($conn, $_POST['sc_balance']);
		// $lastAmountBalance = $amount_balance;

		if (empty($date) || empty($loan_amount)) {
			// || empty($loan_amount) || empty($payment_amount) || empty($or_num) || empty($or_date) || empty($amount_balance) || empty($loan_balance) || empty($sc_starts) || empty($four_percent) || empty($sc_dates) || empty($months) || empty($four_percent_sc)) {
			$err = "<font color='red'>Fill in all the required fields</font>";
		} else {

			$sql = "INSERT INTO $tableName (date, loan_amount, payment_amount, or_num, or_date, amount_balance, loan_balance, sc_starts, four_percent, sc_dates, months, four_percent_sc, sc_payments, sc_payments_or_num, sc_payments_date, sc_balance) VALUES (
                '$date', '$loan_amount', '$payment_amount', '$or_num', '$or_date', '$amount_balance', '$loan_balance', '$sc_starts', '$four_percent', '$sc_dates', '$months', '$four_percent_sc', '$sc_payments', '$sc_payments_or_num', '$sc_payments_date', '$sc_balance'
            )";

			if (mysqli_query($conn, $sql)) {
				header("Location: index.php?page=display_loan&name=" . urlencode($tableName));
				exit;
			} else {
				$err = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
			}
		}
	}
}
?>

<h2 align="center">Add Loan Details</h2>
<form method="post">

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<?php echo @$err; ?>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Date</div>
		<div class="col-sm-5">
			<input type="date" name="date" class="form-control" required />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Loan Amount</div>
		<div class="col-sm-5">
			<input type="float" id="loan_amount" name="loan_amount" class="form-control" required />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Payment Amount</div>
		<div class="col-sm-5">
			<input type="float" id="payment_amount" name="payment_amount" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR #</div>
		<div class="col-sm-5">
			<input type="number" name="or_num" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR Date</div>
		<div class="col-sm-5">
			<input type="date" name="or_date" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Amount Balance</div>
		<div class="col-sm-5">
			<input type="float" id="amount_balance" name="amount_balance" class="form-control" readonly />
		</div>
	</div>

	<script>
		// Function to calculate amount balance
		function calculateAmountBalance() {
			var loanAmount = parseFloat(document.getElementById('loan_amount').value) || 0;
			var paymentAmount = parseFloat(document.getElementById('payment_amount').value) || 0;
			var amountBalance = loanAmount - paymentAmount;
			document.getElementById('amount_balance').value = amountBalance;
		}

		// Attach the function to the input field's onchange event
		document.getElementById('payment_amount').addEventListener('input', calculateAmountBalance);
	</script>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Loan Balance</div>
		<div class="col-sm-5">
			<input type="float" name="loan_balance" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Starts</div>
		<div class="col-sm-5">
			<input type="text" name="sc_starts" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">@ 4%</div>
		<div class="col-sm-5">
			<input type="float" id="four_percent" name="four_percent" class="form-control" readonly />
		</div>
	</div>

	<!-- JavaScript to calculate the 4% and update the input field -->
	<script>
		// Function to calculate 4% of loan amount
		function calculateFourPercent() {
			var loanAmount = parseFloat(document.getElementById('loan_amount').value) || 0;
			var fourPercent = loanAmount * 0.04;
			document.getElementById('four_percent').value = fourPercent;
		}

		// Attach the function to the input field's onchange event
		document.getElementById('loan_amount').addEventListener('input', calculateFourPercent);
	</script>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Dates</div>
		<div class="col-sm-5">
			<input type="text" name="sc_dates" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Months</div>
		<div class="col-sm-5">
			<input type="number" name="months" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">4% SC</div>
		<div class="col-sm-5">
			<input type="float" name="four_percent_sc" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Payments</div>
		<div class="col-sm-5">
			<input type="float" name="sc_payments" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC OR#</div>
		<div class="col-sm-5">
			<input type="number" name="sc_payments_or_num" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Date</div>
		<div class="col-sm-5">
			<input type="date" name="sc_payments_date" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Balance</div>
		<div class="col-sm-5">
			<input type="float" name="sc_balance" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<input type="submit" value="Process New Loan" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
		<div class="col-sm-4"></div>
	</div>
</form>