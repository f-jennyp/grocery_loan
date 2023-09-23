<?php
include('../../connection.php');
if (isset($_GET['table'])) {
	$tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));
	$q = mysqli_query($conn, "SELECT * FROM `$tableName`");
	if (!$q) {
		echo "Query Error: " . mysqli_error($conn);
		die();
	}

	?>
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<style>
		/* Add table styles */
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th,
		td {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		.print-button {
			text-align: center;
			margin-top: 20px;
		}
	</style>
	<table class="table table-bordered">
		<tr height="30" class="info">
			<th colspan="18" align="center">
				<center><?php echo str_replace('_', ' ', $tableName) ?></center>
			</th>
		</tr>
		<Tr class="active">
			<th>No</th>
			<th>Date</th>
			<th>Loan Amount</th>
			<th>Payment Amount</th>
			<th>Payment OR#</th>
			<th>Payment Date</th>
			<th>Amount Balance</th>
			<th>Loan Balance</th>
			<th>SC Starts</th>
			<th>@ 4%</th>
			<th>SC Dates</th>
			<th>#Mos.</th>
			<th>4% SC</th>
			<th>SC Payments</th>
			<th>SC OR#</th>
			<th>SC Date</th>
			<th>SC Balance</th>
		</Tr>
		<?php


		$i = 1;
		while ($row = mysqli_fetch_assoc($q)) {

			echo "<tr>";
			echo "<td>" . $i . "</td>";
			// echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['date'] . "</td>";
			echo "<td>" . $row['loan_amount'] . "</td>";
			echo "<td>" . $row['payment_amount'] . "</td>";
			echo "<td>" . $row['or_num'] . "</td>";
			echo "<td>" . $row['or_date'] . "</td>";
			echo "<td>" . $row['amount_balance'] . "</td>";
			echo "<td>" . $row['loan_balance'] . "</td>";
			echo "<td>" . $row['sc_starts'] . "</td>";
			echo "<td>" . $row['four_percent'] . "</td>";
			echo "<td>" . $row['sc_dates'] . "</td>";
			echo "<td>" . $row['months'] . "</td>";
			echo "<td>" . $row['four_percent_sc'] . "</td>";
			echo "<td>" . $row['sc_payments'] . "</td>";
			echo "<td>" . $row['sc_payments_or_num'] . "</td>";
			echo "<td>" . $row['sc_payments_date'] . "</td>";
			echo "<td>" . $row['sc_balance'] . "</td>";
			echo "</tr>";

			?>

			<?php

			echo "</Tr>";
			$i++;
		}
		?>


	</table>

	<script>
		function printpage() {
			var printButton = document.getElementById("printpagebutton");
			printButton.style.visibility = 'hidden';
			window.print();
			printButton.style.visibility = 'visible';
		}
	</script>

	<div class="print-button">
		<button id="printpagebutton" class="btn btn-primary" onClick="printpage()">
			<span class="glyphicon glyphicon-print"></span> &nbsp;Print
		</button>
	</div>

	<?php
} ?>