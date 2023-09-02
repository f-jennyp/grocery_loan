<?php
include('../connection.php');
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));
	$q = mysqli_query($conn, "SELECT * FROM $tableName");
	if (!$q) {
		echo "Query Error: " . mysqli_error($conn);
		die();
	}
	
?>
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<table class="table table-bordered">
	<tr height="30" class="info">
		<th colspan="7" align="center">
			<center>All Loan Records</center>
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

		echo "<Tr>";
		echo "<td>" . $i . "</td>";


		$q1 = mysqli_query($conn, "select * from $tableName where id='" . $row['id'] . "'");
		$r1 = mysqli_fetch_assoc($q1);

		echo "<td>" . $r1['date'] . "</td>";
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

	?>

	<?php

		echo "</Tr>";
		$i++;
	}
	?>

	<tr>
		<script>
			function printpage() {
				//Get the print button and put it into a variable
				var printButton = document.getElementById("printpagebutton");
				//Set the print button visibility to 'hidden' 
				printButton.style.visibility = 'hidden';
				//Print the page content
				window.print()
				//Set the print button to 'visible' again 
				//[Delete this line if you want it to stay hidden after printing]
				printButton.style.visibility = 'visible';
				window.print();
			}
		</script>

		<td colspan="7" align="center">
			<button id="printpagebutton" class="btn btn-primary" onClick="printpage()"><span class="glyphicon glyphicon-print"></span> &nbsp;Print</button>
		</td>
	</tr>

</table>
<?php
} ?>