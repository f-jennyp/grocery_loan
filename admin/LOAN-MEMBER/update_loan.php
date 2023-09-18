<?php

if (isset($_GET['name'])) {
	$tableName = mysqli_real_escape_string($conn, urldecode($_GET['name']));

	$q = mysqli_query($conn, "SELECT * FROM `$tableName`");
	if (!$q) {
		echo "Query Error: " . mysqli_error($conn);
		die();
	}

	extract($_POST);
	if (isset($save)) {
		$id = intval($_GET['id']);

		mysqli_query($conn, "UPDATE `$tableName` SET  
            `date`='$date', 
            `loan_amount`='$loan_amount', 
            `payment_amount`='$payment_amount', 
            `or_num`='$or_num', 
            `or_date`='$or_date', 
            `amount_balance`='$amount_balance', 
            `loan_balance`='$loan_balance', 
            `sc_starts`='$sc_starts', 
            `four_percent`='$four_percent', 
            `sc_dates`='$sc_dates', 
            `months`='$months', 
            `four_percent_sc`='$four_percent_sc', 
            `sc_payments`='$sc_payments', 
            `sc_payments_or_num`='$sc_payments_or_num', 
            `sc_payments_date`='$sc_payments_date', 
            `sc_balance`='$sc_balance'
            WHERE `id`='$id'
        ");

		header("Location: index.php?page=display_loan&name=" . urlencode($tableName));
		exit;
	}

	$sql = mysqli_query($conn, "SELECT * FROM `$tableName` WHERE id='" . $_GET['id'] . "'");
	$res = mysqli_fetch_array($sql);
}
?>
<h2 align="center">Update
	<?php echo str_replace('_', ' ', $tableName) ?> record
</h2>
<form method="post">

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<?php echo @$err; ?>
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">DATE <span style="color: red;">*</span></div>
		<div class="col-sm-5">
			<input type="date" value="<?php echo $res['date']; ?>" name="date" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Loan Amount <span style="color: red;">*</span></div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['loan_amount']; ?>" id="loan_amount" name="loan_amount"
				class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Payment Amount <span style="color: red;">*</span></div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['payment_amount']; ?>" id="payment_amount" name="payment_amount"
				class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR #</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['or_num']; ?>" name="or_num" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">OR DATE</div>
		<div class="col-sm-5">
			<input type="date" value="<?php echo $res['or_date']; ?>" name="or_date" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Amount Balance</div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['amount_balance']; ?>" id="amount_balance" name="amount_balance"
				class="form-control" readonly />
		</div>
	</div>

	<script>
		// Function to calculate amount balance
		function calculateAmountBalance() {
			var loanAmount = document.getElementById('loan_amount').value;
			var paymentAmount = document.getElementById('payment_amount').value;
			var amountBalance = loanAmount - paymentAmount;
			document.getElementById('amount_balance').value = amountBalance;
		}

		// Attach the function to the input field's onchange event
		document.getElementById('payment_amount').addEventListener('input', calculateAmountBalance);
	</script>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Loan Balance</div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['loan_balance']; ?>" name="loan_balance" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Starts</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $res['sc_starts']; ?>" name="sc_starts" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">@ 4%</div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['four_percent']; ?>" id="four_percent" name="four_percent"
				class="form-control" readonly />
		</div>
	</div>

	<script>
		function calculateFourPercent() {
			var loanAmount = document.getElementById('loan_amount').value;
			var fourPercent = loanAmount * 0.04;
			document.getElementById('four_percent').value = fourPercent;
		}
		document.getElementById('loan_amount').addEventListener('input', calculateFourPercent);
	</script>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Dates</div>
		<div class="col-sm-5">
			<input type="text" value="<?php echo $res['sc_dates']; ?>" name="sc_dates" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Months</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['months']; ?>" id="months" name="months" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">4% SC</div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['four_percent_sc']; ?>" id="four_percent_sc" name="four_percent_sc"
				class="form-control" readonly />
		</div>
	</div>

	<script>
		function calculateFourPercentSC() {
			var loanAmount = parseFloat(document.getElementById('loan_amount').value) || 0;
			var months = parseInt(document.getElementById('months').value) || 0;
			var fourPercentSC = (loanAmount * 0.04) * months;
			document.getElementById('four_percent_sc').value = fourPercentSC.toFixed(2); // Limit to 2 decimal places
		}
		document.getElementById('months').addEventListener('input', calculateFourPercentSC);
		document.getElementById('loan_amount').addEventListener('input', calculateFourPercentSC);
	</script>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Payments</div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['sc_payments']; ?>" id="sc_payments" name="sc_payments" class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC OR#</div>
		<div class="col-sm-5">
			<input type="number" value="<?php echo $res['sc_payments_or_num']; ?>" name="sc_payments_or_num"
				class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Date</div>
		<div class="col-sm-5">
			<input type="date" value="<?php echo $res['sc_payments_date']; ?>" name="sc_payments_date"
				class="form-control" />
		</div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">SC Balance</div>
		<div class="col-sm-5">
			<input type="float" value="<?php echo $res['sc_balance']; ?>" id="sc_balance" name="sc_balance" class="form-control" readonly />
		</div>
	</div>

	<script>
		function calculateSCBalance() {
			var loanAmount = parseFloat(document.getElementById('loan_amount').value) || 0;
			var months = parseInt(document.getElementById('months').value) || 0;
			var fourPercentSC = (loanAmount * 0.04) * months;
			var scPayments = parseFloat(document.getElementById('sc_payments').value) || 0;
			var scBalance = fourPercentSC - scPayments;
			document.getElementById('sc_balance').value = scBalance.toFixed(2); // Limit to 2 decimal places
		}
		document.getElementById('months').addEventListener('input', calculateSCBalance);
		document.getElementById('loan_amount').addEventListener('input', calculateSCBalance);
		document.getElementById('sc_payments').addEventListener('input', calculateSCBalance);
	</script>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<input type="submit" value="Update Loan" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
		<div class="col-sm-4"></div>
	</div>
</form>