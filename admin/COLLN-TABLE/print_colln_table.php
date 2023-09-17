<?php
include('../../connection.php');
if (isset($_GET['table'])) {
	$tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));
	$q = mysqli_query($conn, "SELECT * FROM $tableName");
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
				<center>All Loan Records</center>
			</th>
		</tr>
		<Tr class="active">
        <th>#</th>
			<th>Date</th>
			<th>OR #</th>
			<th>Charged Colln</th>
			<th>Total (Charged Colln)</th>
			<th>D. Sales for</th>
			<th>Amount</th>
			<th>Overage</th>
			<th>Total</th>
			<th>C. Total</th>
		</Tr>
		<?php


		$i = 1;
		while ($row = mysqli_fetch_assoc($q)) {

			echo "<tr>";
			echo "<td>" . $i . "</td>";
            echo "<td>" . $row['date'] . "</td>";
			echo "<td>" . $row['or_num'] . "</td>";
			echo "<td>" . $row['charged_colln'] . "</td>";
			echo "<td>" . $row['charged_total'] . "</td>";
			echo "<td>" . $row['d_sales_for'] . "</td>";
			echo "<td>" . $row['amount'] . "</td>";
			echo "<td>" . $row['overage'] . "</td>";
			echo "<td>" . $row['total'] . "</td>";
			echo "<td>" . $row['c_total'] . "</td>";
			echo "</tr>";
			$i++;
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