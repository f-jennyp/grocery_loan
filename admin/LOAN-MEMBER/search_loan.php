<?php
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));

$search = $_POST['searchLoan'];
$search = mysqli_real_escape_string($conn, $_POST['searchLoan']);

$q = mysqli_query($conn, "select * from $tableName WHERE date = '$search' OR or_num = '$search'");
$rr = mysqli_num_rows($q);
if (!$rr) {
	echo "<div class='alert alert-danger'><h2>No Result Found!</h2></div>";
} else {
	?>
	<script>
		function DeleteLoan(id, tableName) {
			if (confirm("You want to delete this record?")) {
				window.location.href = "LOAN-MEMBER/delete_loan.php?id=" + id + "&tableName=" + tableName;
			}
		}
	</script>
	<h2 align="center">Search Results</h2>
	<table class="table table-bordered">

		<tr>
			<td colspan="16"><a href="index.php?page=display_loan&name=<?php echo urlencode($tableName); ?>">Go Back</a></td>
		</tr>
		<Tr class="active">
		<th>#</th>
			<th>Date</th>
			<th>Loan Amount</th>
			<th>Payment Amount</th>
			<th>Payment OR#</th>
			<th>Payment Date</th>
			<th>Amount Balance</th>
			<th>Laon Balance</th>
			<th>SC Starts</th>
			<th>@ 4%</th>
			<th>SC Dates</th>
			<th>#Mos.</th>
			<th>4% SC</th>
			<th>SC Payments</th>
			<th>SC OR#</th>
			<th>SC Date</th>
			<th>SC Balance</th>
			<th>Actions</th>
		</Tr>
		<?php


		$i = 1;
		while ($row = mysqli_fetch_assoc($q)) {

			echo "<Tr>";
			echo "<td>" . $i . "</td>";
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
			?>

			<Td>

			<a href="javascript:DeleteLoan('<?php echo $row['id']; ?>', '<?php echo urlencode($tableName); ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

			<a href="index.php?page=update_loan&id=<?php echo $row['id']; ?>&name=<?php echo urlencode($tableName); ?>" style='color:green'><span class='glyphicon glyphicon-edit'></span></a>


			</td>
			<?php

			echo "</Tr>";
			$i++;
		}
		?>

	</table>
<?php } } ?>